<?php

namespace App\Http\Controllers;

use App\Events\OrderCreateEvent;
use App\Events\OrderDeleteEvent;
use App\Mail\OrderShippedMail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use \TCG\Voyager\Http\Controllers\VoyagerBaseController;
use DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends VoyagerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //ajax request
    public function productByDepartment(Request $request)
    {

        $products = Product::where('department_id', $request->department_id)->get();

        return view('ajaxRequestData.formfields', compact('products'));
    }

    //ajax request
    public function changeOrderStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);

        $value = '';
        $role = auth()->user()->role->name;

        if ($role) {
            if ($role == 'admin' && $order->status_value == 0) {
                $value = 1;
                $order->update(['status' => (int) $value]);
                Mail::to(config('mail.address.store_keeper'))->send(new OrderShippedMail($order, 'You have an order'));
                return $order->status;
            } else if ($role == 'store_incharge' && $order->status_value == 1) {
                $value = 2;
                $order->update(['status' => (int) $value]);
                Mail::to($order->orderUser->email)->send(new OrderShippedMail($order, 'Order on the way to site'));
                return $order->status;
            } else if ($role == 'supervisor' && $order->status_value == 2) {
                $value = 3;
                $order->update(['status' => (int) $value]);
                Mail::to(config('mail.address.admin'))->send(new OrderShippedMail($order, 'Order has been recieved'));
                return $order->status;
            } else if ($role == 'general_manager' && $order->status_value == 3) {
                $value = 4;
                $order->update(['status' => (int) $value]);
                Mail::to(config('mail.address.admin'))->send(new OrderShippedMail($order, 'Site Closed'));
                return $order->status;
            }
        }
        return $order->status;
    }

    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        $this->authorize('browse_bread');
        try {

            $this->orderValidation($request);

            $res = auth()->user()->orders()->create($request->except(['product_id', 'number']));
            $data = $res
                ? $this->alertSuccess(__('voyager::bread.success_created_bread'))
                : $this->alertError(__('voyager::bread.error_creating_bread'));

            //add data to product_order table
            $this->saveToOrderProductTable($request, $res->id);

            event(new OrderCreateEvent($res));

            return redirect()->route('voyager.orders.index')->with($data);
        } catch (Exception $e) {
            return redirect()->route('voyager.orders.index')->with($this->alertException($e, 'Saving Failed'));
        }
    }


    public function orderValidation($request)
    {
        return $request->validate([
            'department_id' => 'required',
            'project_id' => 'required',
            'number' => 'required',
        ]);
    }

    public function saveToOrderProductTable($request, $id)
    {

        $department_id = $request->department_id;
        $project_id = $request->project_id;
        $products = [];
        $i = 0;
        foreach ($request->product_id as $product_id) {
            if ($request->number[$i]) {

                DB::table('products')->where('id', $product_id)
                    ->decrement('total',  (int) $request->number[$i]);
                $products[] = [
                    'order_id' => $id,
                    'department_id' => $department_id,
                    'project_id' => $project_id,
                    'product_id' => $product_id,
                    'numbers' => $request->number[$i],
                ];
            }
            $i++;
        }
        DB::table('order_products')->insert($products);
    }





    /**
     * Delete BREAD.
     *
     * @param Number $id BREAD data_type id.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        if (auth()->user()->id != $order->user_id) {
            abort('403', 'You are not permitted to delete this order');
        }
        if ($order->status_value == 0 || $order->status_value == 4) {

            foreach ($order->orderProducts as  $product) {
                Product::findOrFail($product->product_id)
                    ->increment('total',  (int) $product->numbers);
            }
            $res = $order->forceDelete();
            $data = $res
                ? $this->alertSuccess(__('voyager::bread.success_remove_bread'))
                : $this->alertError(__('voyager::bread.error_updating_bread'));

            event(new OrderDeleteEvent($order));

            return redirect()->route('voyager.orders.index')->with($data);
        }
        abort('403', 'Order admin already approved, can not be deleted');
    }
}

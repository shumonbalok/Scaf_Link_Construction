<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\ReturnOrder;
use App\Models\OrderProduct;
use App\Models\ReturnProduct;
use \TCG\Voyager\Http\Controllers\VoyagerBaseController;
use Illuminate\Support\Facades\Validator;
use DB;

class ReturnController extends VoyagerBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAndSaveReturn(Request $request)
    {
        $this->authorize('browse_bread');
        //return $request->all();

        if ($request->product_id) {
            return $this->save($request);
        }
        $validation = Validator::make($request->all(), [
            'department_id' => 'required',
            'project_id' => 'required'
        ]);
        if ($validation->fails()) {
            return response()->json([
                'errors' => "Field can not be empty!",
            ]);
        }
        $department_id = $request->department_id;
        $project_id = $request->project_id;
        $notApproveOrders = Order::where('status', 3)->get();
        $notApproveOrdersId = $notApproveOrders->pluck('id');
        $products = OrderProduct::whereIn('order_id', $notApproveOrdersId)->where([['department_id', $department_id], ['project_id', $project_id]])->get();

        $this->saveOrderAndReturnTable($products, $department_id, $project_id, $table = "order_product_total");

        if ($products->count() == 0) {
            return response()->json([
                'errors' => "Product not found!",
            ]);
        }

        $orderProducts = DB::table('order_product_total')->where([['department_id', $department_id], ['project_id', $project_id]])->get();
        $returnProducts = DB::table('return_product_total')->where([['department_id', $department_id], ['project_id', $project_id]])->get();

        $uniqueProducts = [];
        $i = 0;
        if ($orderProducts) {
            foreach ($orderProducts as $orderProduct) {

                $total_products = (int) $orderProduct->total_products;

                if ($returnProducts) {
                    foreach ($returnProducts as $returnProduct) {
                        if ($orderProduct->product_id == $returnProduct->product_id) {
                            $total_products -= (int) $returnProduct->total_products;
                        }
                    }
                }
                $uniqueProducts[] = [
                    'product_id' => $orderProduct->product_id,
                    'total_products' => $total_products,
                ];

                $i++;
            }
        }

        return view('ajaxRequestData.table', compact('uniqueProducts'));
    }

    public function saveOrderAndReturnTable($products, $department_id, $project_id, $table)
    {
        $uniqueProducts = $products->groupBy('product_id')
            ->map(function ($item, $value) {
                return $item->sum('numbers');
            });

        //save to order_product_total table               
        foreach ($uniqueProducts as $key => $value) {
            $product = DB::table($table)
                ->where([['department_id', $department_id], ['project_id', $project_id], ['product_id', $key]])->first();
            if (!$product) {
                DB::table($table)->insert([
                    'department_id' => $department_id,
                    'project_id' => $project_id,
                    'product_id' => $key,
                    'total_products' => $value,
                ]);
            } else {
                if ($product->total_products !== $value) {
                    DB::table($table)
                        ->where([['department_id', $department_id], ['project_id', $project_id], ['product_id', $key]])->update(['total_products' => $value]);
                }
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function save($request)
    {
        //return $request->all();

        try {

            $this->orderValidation($request);

            $res = auth()->user()->returnOrders()->create($request->except(['product_id', 'number']));
            $data = $res
                ? $this->alertSuccess(__('voyager::bread.success_created_bread'))
                : $this->alertError(__('voyager::bread.error_creating_bread'));

            //add data to return_product table
            $this->saveToReturnProductTable($request, $res->id);

            //add data to return_product_total table
            $department_id = $request->department_id;
            $project_id = $request->project_id;
            $products = ReturnProduct::where([['department_id', $department_id], ['project_id', $project_id]])->get();
            $uniqueProducts = $products->groupBy('product_id')
                ->map(function ($item, $value) {
                    return $item->sum('numbers');
                });
            $this->saveOrderAndReturnTable($products, $department_id, $project_id, $table = "return_product_total");

            return redirect()->route('voyager.return-orders.index')->with($data);
        } catch (Exception $e) {
            return redirect()->route('voyager.return-orders.index')->with($this->alertException($e, 'Saving Failed'));
        }
    }

    public function orderValidation($request)
    {
        return $request->validate([
            'department_id' => 'required',
            'project_id' => 'required',
            'numbers' => 'required',
        ]);
    }
    public function saveToReturnProductTable($request, $id)
    {

        $products = [];
        $i = 0;
        foreach ($request->product_id as $product_id) {
            if ($request->numbers[$i]) {

                // DB::table('products')->where('id', $product_id)
                //     ->increment('total',  (int) $request->numbers[$i]);

                $products[] = [
                    'return_order_id' => $id,
                    'department_id' => $request->department_id,
                    'project_id' => $request->project_id,
                    'product_id' => $product_id,
                    'numbers' => $request->numbers[$i]
                ];
            }
            $i++;
        }
        DB::table('return_products')->insert($products);

        return;
    }

    public function changeReturnStatus(Request $request)
    {
        $returnOrder = ReturnOrder::findOrFail($request->id);

        $value = '';
        $role = auth()->user()->role->name;

        if ($role) {
            if ($role == 'store_incharge' && $returnOrder->status_value == 0) {
                $returnOrderProducts = $returnOrder->returnProducts;
                foreach ($returnOrderProducts as $order) {
                    DB::table('products')->where('id', $order->product_id)
                        ->increment('total',  (int) $order->numbers);
                }
                $returnOrder->update(['status' => 1]);
            } else if ($role == 'admin' && $returnOrder->status_value == 1) {
                $returnOrder->update(['status' => 2]);
            }
        }

        return $returnOrder->status;
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

        $order = auth()->user()->returnOrders->find($id);

        if ($order->status_value == 0 || $order->status_value == 2) {
            $res = $order->delete();
            $data = $res
                ? $this->alertSuccess(__('voyager::bread.success_remove_bread'))
                : $this->alertError(__('voyager::bread.error_updating_bread'));

            return redirect()->route('voyager.return-orders.index')->with($data);
        }
        abort('403', 'Order admin already approved, can not be deleted');
    }
}

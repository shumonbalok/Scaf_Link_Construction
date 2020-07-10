@component('mail::message')
# New Order

<p> <strong> {{$order->orderUser->name}}</strong> have an order from <strong>{{$order->department->name}}</strong>
    department </p>
<p>for <strong>{{$order->project->name}} </strong>project. Please approved.</p>

@component('mail::button', ['url' => route('voyager.orders.show', $order->id)])
Go to order
@endcomponent

Thanks,<br>
{{ config('app.name') }} <br>
{{$order->orderUser->name}}
@endcomponent
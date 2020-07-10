@component('mail::message')
# An Order(no. {{$order->id}})

{{$message}}

@component('mail::button', ['url' => route('voyager.orders.show', $order->id)])
Review it please
@endcomponent

Thanks,<br>
{{ config('app.name') }}<br>
{{auth()->user()->name}}
@endcomponent
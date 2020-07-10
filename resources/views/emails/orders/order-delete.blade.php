@component('mail::message')
# Order no.{{$order->id)}} <br>
has been deleted by
{{auth()->user()->name}}

Thanks,<br>
{{ config('app.name') }},<br>
{{auth()->user()->name}}
@endcomponent
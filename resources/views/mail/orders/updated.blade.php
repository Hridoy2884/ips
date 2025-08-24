@component('mail::message')
# Order Updated

Hello {{ $order->user->name }},

Your order has been updated. Here are the changes:

@foreach($changes as $field => $value)
- **{{ ucfirst(str_replace('_', ' ', $field)) }}:** {{ $value }}
@endforeach

**Shipping Method / Courier:** {{ $courier_name }}

@component('mail::button', ['url' => $url])
View Your Order
@endcomponent

Thanks,<br>
juipowerbd.com
@endcomponent

<x-mail::message>
# Order Placed successfully!

Hello Sir/Madam,<br>
Thank you for your order! Your order number is **{{ $order->id }}**. We are currently processing your order and will notify you once it has been shipped.

<x-mail::button :url="$url">
View Order Details
</x-mail::button>

Thanks,<br>
Gadegty
</x-mail::message>

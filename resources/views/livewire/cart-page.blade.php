<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-6 text-slate-700">Shopping Cart</h1>

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Cart Items -->
            <div class="lg:w-3/4 w-full">
                <div class="bg-white rounded-lg shadow-md overflow-x-auto">
                    <table class="w-full min-w-[640px] table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="text-left p-3 font-semibold text-sm">Product</th>
                                <th class="text-left p-3 font-semibold text-sm">Price</th>
                                <th class="text-left p-3 font-semibold text-sm">Quantity</th>
                                <th class="text-left p-3 font-semibold text-sm">Total</th>
                                <th class="text-left p-3 font-semibold text-sm">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cart_items as $item)
                                <tr wire:key="{{ $item['product_id'] }}" class="border-b">
                                    <td class="p-3">
                                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-4">
                                            <img class="h-16 w-16 object-cover rounded" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">
                                            <span class="font-medium text-sm break-words">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="p-3 text-sm whitespace-nowrap">{{ Number::currency($item['unit_amount'], 'BDT') }}</td>
                                    <td class="p-3 text-sm">
                                        <div class="flex items-center gap-2">
                                            <button wire:click='decreaseQty({{ $item['product_id'] }})' class="border rounded px-3 py-1 hover:bg-gray-100">-</button>
                                            <span class="w-8 text-center">{{ $item['quantity'] }}</span>
                                            <button wire:click='increaseQty({{ $item['product_id'] }})' class="border rounded px-3 py-1 hover:bg-gray-100">+</button>
                                        </div>
                                    </td>
                                    <td class="p-3 text-sm whitespace-nowrap">{{ Number::currency($item['total_amount'], 'BDT') }}</td>
                                    <td class="p-3">
                                        <button wire:click='removeItem({{ $item['product_id'] }})' class="bg-slate-300 border rounded px-3 py-1 hover:bg-red-500 hover:text-white">Remove</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-4 text-gray-500">Your cart is empty.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Summary -->
            <div class="lg:w-1/4 w-full">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                    <h2 class="text-lg font-semibold mb-4">Summary</h2>
                    <div class="flex justify-between mb-2">
                        <span>Subtotal</span>
                        <span>{{ Number::currency($grand_total, 'BDT') }}</span>
                    </div>
                  
                    <hr class="my-2">
                    <div class="flex justify-between font-semibold mb-4">
                        <span>Total</span>
                        <span>{{ Number::currency($grand_total, 'BDT') }}</span>
                    </div>

                    @if(count($cart_items) > 0)
                        <a href="/checkout" class="bg-blue-500 block text-center text-white py-2 px-4 rounded-lg w-full hover:bg-blue-600">Checkout</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Checkout</h1>

    <form wire:submit.prevent="placeOrder" enctype="multipart/form-data">
        <div class="grid grid-cols-12 gap-4">
            <!-- Left: Shipping + Payment -->
            <div class="md:col-span-12 lg:col-span-8 col-span-12">
                <!-- Shipping Address Card -->
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900 mb-6">
                    <h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">Shipping Address</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-gray-700 dark:text-white mb-1">First Name</label>
                            <input wire:model="first_name" id="first_name" type="text"
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('first_name') border-red-500 @enderror">
                            @error('first_name')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="last_name" class="block text-gray-700 dark:text-white mb-1">Last Name</label>
                            <input wire:model="last_name" id="last_name" type="text"
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('last_name') border-red-500 @enderror">
                            @error('last_name')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="phone" class="block text-gray-700 dark:text-white mb-1">Phone</label>
                        <input wire:model="phone" id="phone" type="text"
                            class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="street_address" class="block text-gray-700 dark:text-white mb-1">Address</label>
                        <input wire:model="street_address" id="street_address" type="text"
                            class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('street_address') border-red-500 @enderror">
                        @error('street_address')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="city" class="block text-gray-700 dark:text-white mb-1">City</label>
                        <input wire:model="city" id="city" type="text"
                            class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('city') border-red-500 @enderror">
                        @error('city')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="district" class="block text-gray-700 dark:text-white mb-1">District</label>
                            <input wire:model="district" id="district" type="text"
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('district') border-red-500 @enderror">
                            @error('district')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="zip_code" class="block text-gray-700 dark:text-white mb-1">ZIP Code</label>
                            <input wire:model="zip_code" id="zip_code" type="text"
                                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('zip_code') border-red-500 @enderror">
                            @error('zip_code')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- End Shipping Address -->

                <!-- Payment Method Card -->
<div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">

    <div class="text-lg font-semibold mb-4">Select Payment Method</div>

    {{-- Payment Method Radio Buttons --}}
    <div class="grid grid-cols-2 gap-4 mb-4">
        <label class="flex items-center gap-2 p-3 border rounded cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition">
            <input type="radio" wire:model="payment_method" name="payment_method" value="cod">
            <span class="text-gray-700 dark:text-white font-semibold">Cash on Delivery</span>
        </label>

        <label class="flex items-center gap-2 p-3 border rounded cursor-pointer hover:border-pink-500 hover:bg-pink-50 transition">
            <input type="radio" wire:model="payment_method" name="payment_method" value="bkash">
            <span class="text-gray-700 dark:text-white font-semibold">bKash</span>
        </label>

        <label class="flex items-center gap-2 p-3 border rounded cursor-pointer hover:border-orange-500 hover:bg-orange-50 transition">
            <input type="radio" wire:model="payment_method" name="payment_method" value="nagad">
            <span class="text-gray-700 dark:text-white font-semibold">Nagad</span>
        </label>

        <label class="flex items-center gap-2 p-3 border rounded cursor-pointer hover:border-purple-500 hover:bg-purple-50 transition">
            <input type="radio" wire:model="payment_method" name="payment_method" value="rocket">
            <span class="text-gray-700 dark:text-white font-semibold">Rocket</span>
        </label>

        <label class="flex items-center gap-2 p-3 border rounded cursor-pointer hover:border-green-500 hover:bg-green-50 transition">
            <input type="radio" wire:model="payment_method" name="payment_method" value="bank">
            <span class="text-gray-700 dark:text-white font-semibold">Bank Transfer</span>
        </label>
    </div>

    {{-- COD Section --}}
    @if($payment_method === 'cod')
        <div class="mt-4 p-4 border rounded bg-gray-50">
            <p>Please pay <strong>15% of your order total</strong> using one of the methods below and enter your transaction ID:</p>

            <ul class="list-none mt-3 space-y-2">
                <li>
                    <p class="font-semibold">Send Money to:</p>
                    <p class="text-xl font-bold text-green-600">01713540038</p>
                    <p class="text-sm text-gray-600">bKash / Nagad / Rocket</p>
                </li>
                <h3 class="text-lg font-bold mt-4">Bank Accounts</h3>
                <ul class="space-y-1 mt-2 text-gray-700">
                    <li>MD Shohag: 1231510139529, DBBL</li>
                    <li>JUI ELECTRIC: 2053722710001, Brac Bank</li>
                    <li>MD SHOHAG: 20503240202184517, IBBL</li>
                </ul>
            </ul>

            <div class="mt-3">
                <label class="block mb-1">Transaction ID</label>
                <input type="text" wire:model="transaction_id" class="w-full rounded border p-2" placeholder="Enter Transaction ID">
                @error('transaction_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>
@elseif(in_array($payment_method, ['bkash','nagad','rocket']))
    {{-- Online Payment Section --}}
    <div class="mt-4 p-4 border rounded bg-gray-50">
        <p class="font-semibold text-lg">Payment Instruction</p>

<p class="text-red-600 mt-2">
    Please complete your payment through 
    <strong>{{ ucfirst($payment_method) }} (Send Money)</strong> first, 
    then fill up the form below. 
    Also note that <strong>1.85% {{ ucfirst($payment_method) }} "SEND MONEY"</strong> cost will be added with net price. 
    Total amount you need to send us: 
    <span class="font-bold text-black">৳ {{ number_format($total_with_fee, 2) }}</span>.<br>
    
<strong>{{ ucfirst($payment_method) }} Number:</strong> 
<span 
    x-data="{ copied: false }" 
    @click="navigator.clipboard.writeText('01713540038').then(() => { copied = true; setTimeout(() => copied = false, 1500) })" 
    class="font-bold text-black cursor-pointer underline hover:text-blue-600 relative"
    title="Click to copy"
>
    01713540038

    <!-- Copied badge -->
    <span 
        x-show="copied" 
        x-transition 
        class="absolute -top-6 left-1/2 -translate-x-1/2 px-2 py-1 text-xs rounded bg-green-500 text-white shadow"
    >
        Copied!
    </span>
</span>



        <div class="mt-3">
            <label class="block mb-1">Transaction ID</label>
            <input type="text" wire:model="transaction_id" class="w-full rounded border p-2" placeholder="Enter Transaction ID">
            @error('transaction_id') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <label class="block mb-1">Upload Payment Proof (optional)</label>
            <input type="file" wire:model="payment_proof" accept="image/*" class="w-full">
            @error('payment_proof') <span class="text-red-600">{{ $message }}</span> @enderror

            @if($payment_proof)
                <img src="{{ $payment_proof->temporaryUrl() }}" class="mt-2 max-w-xs rounded border" />
            @endif
        </div>
    </div>

    @elseif($payment_method === 'bank')
        {{-- Bank Transfer Section --}}
        <div class="mt-4 p-4 border rounded bg-gray-50">
            <p class="font-semibold text-lg">Bank Transfer Information</p>

            <ul class="list-disc ml-5 mt-2 space-y-1 text-gray-700">
                <li>MD Shohag: 1231510139529, DBBL</li>
                <li>JUI ELECTRIC: 2053722710001, Brac Bank</li>
                <li>MD SHOHAG: 20503240202184517, IBBL</li>
            </ul>

            <div class="mt-4">
                <label class="block mb-1">Transaction ID</label>
                <input type="text" wire:model="transaction_id" class="w-full rounded border p-2" placeholder="Enter Transaction ID">
                @error('transaction_id') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <label class="block mb-1">Upload Payment Proof</label>
                <input type="file" wire:model="payment_proof" accept="image/*" class="w-full">
                @error('payment_proof') <span class="text-red-600">{{ $message }}</span> @enderror

                @if($payment_proof)
                    <img src="{{ $payment_proof->temporaryUrl() }}" class="mt-2 max-w-xs rounded border" />
                @endif
            </div>
        </div>
    @endif

</div>






  <!-- Payment Method Card end-->




            <!-- Right: Order Summary -->
            <div class="md:col-span-12 lg:col-span-4 col-span-12">
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">ORDER SUMMARY</div>
                    <div class="flex justify-between mb-2 font-bold">
                        <span>Subtotal</span>
                        <span>{{ Number::currency($grand_total, 'BDT') }}</span>
                    </div>

                    @if ($payment_method === 'cod' && $advance_amount > 0)
                        <div class="flex justify-between mb-2 font-bold text-blue-700">
                            <span>Advance Payment Required (15%)</span>
                            <span>{{ Number::currency($advance_amount, 'BDT') }}</span>
                        </div>
                    @endif

                    <hr class="bg-slate-400 my-4 h-1 rounded" />

                    <div class="flex justify-between mb-2 font-bold">
                        <span>Grand Total</span>
                        <span>{{ Number::currency($grand_total, 'BDT') }}</span>
                    </div>
                </div>

                <button type="submit"
                    class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                    <span wire:loading.remove>Place Order</span>
                    <span wire:loading>Processing...</span>
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Include Alpine.js for smooth scroll --}}
<script src="//unpkg.com/alpinejs" defer></script>

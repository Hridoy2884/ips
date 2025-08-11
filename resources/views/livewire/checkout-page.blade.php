<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Checkout</h1>

  <form wire:submit.prevent="placeOrder" enctype="multipart/form-data">
    <div class="grid grid-cols-12 gap-4">
      <div class="md:col-span-12 lg:col-span-8 col-span-12">
        <!-- Shipping Address Card -->
        <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900 mb-6">
          <h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">Shipping Address</h2>
          <div class="grid grid-cols-2 gap-4">
            <!-- First Name -->
            <div>
              <label for="first_name" class="block text-gray-700 dark:text-white mb-1">First Name</label>
              <input wire:model="first_name" id="first_name" type="text" 
                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('first_name') border-red-500 @enderror">
              @error('first_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            <!-- Last Name -->
            <div>
              <label for="last_name" class="block text-gray-700 dark:text-white mb-1">Last Name</label>
              <input wire:model="last_name" id="last_name" type="text" 
                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('last_name') border-red-500 @enderror">
              @error('last_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
          </div>
          <!-- Phone -->
          <div class="mt-4">
            <label for="phone" class="block text-gray-700 dark:text-white mb-1">Phone</label>
            <input wire:model="phone" id="phone" type="text" 
              class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('phone') border-red-500 @enderror">
            @error('phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
          </div>
          <!-- Address -->
          <div class="mt-4">
            <label for="street_address" class="block text-gray-700 dark:text-white mb-1">Address</label>
            <input wire:model="street_address" id="street_address" type="text" 
              class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('street_address') border-red-500 @enderror">
            @error('street_address') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
          </div>
          <!-- City -->
          <div class="mt-4">
            <label for="city" class="block text-gray-700 dark:text-white mb-1">City</label>
            <input wire:model="city" id="city" type="text" 
              class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('city') border-red-500 @enderror">
            @error('city') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
          </div>
          <!-- District & ZIP -->
          <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
              <label for="district" class="block text-gray-700 dark:text-white mb-1">District</label>
              <input wire:model="district" id="district" type="text" 
                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('district') border-red-500 @enderror">
              @error('district') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
              <label for="zip_code" class="block text-gray-700 dark:text-white mb-1">ZIP Code</label>
              <input wire:model="zip_code" id="zip_code" type="text" 
                class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('zip_code') border-red-500 @enderror">
              @error('zip_code') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
          </div>
        </div>
        <!-- End Shipping Address Card -->

        <!-- Payment Method Card -->
        <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
          <div class="text-lg font-semibold mb-4">Select Payment Method</div>
          <ul class="grid w-full gap-6 md:grid-cols-2">
            <li>
              <input wire:model="payment_method" class="hidden peer" id="cod" type="radio" value="cod" required />
              <label for="cod" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer
                dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100
                dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                <div class="block w-full text-lg font-semibold">Cash on Delivery (15% advance required)</div>
              </label>
            </li>
            <li>
              <input wire:model="payment_method" class="hidden peer" id="manual" type="radio" value="manual" />
              <label for="manual" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer
                dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100
                dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                <div class="block w-full text-lg font-semibold">Manual Payment (bKash/Nagad/Rocket/Bank)</div>
              </label>
            </li>
          </ul>
          @error('payment_method')
          <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
          @enderror

          @if($payment_method === 'manual')
          <div class="mt-4">
            <label for="transaction_id" class="block mb-1">Transaction ID</label>
            <input wire:model="transaction_id" id="transaction_id" type="text" class="w-full rounded border p-2" />
            @error('transaction_id') <span class="text-red-600">{{ $message }}</span> @enderror
          </div>

          <div class="mt-4">
            <label for="payment_proof" class="block mb-1">Upload Payment Proof (optional)</label>
            <input wire:model="payment_proof" id="payment_proof" type="file" accept="image/*" class="w-full" />
            @error('payment_proof') <span class="text-red-600">{{ $message }}</span> @enderror

            @if ($payment_proof)
            <img src="{{ $payment_proof->temporaryUrl() }}" class="mt-2 max-w-xs rounded" />
            @endif
          </div>
          @endif
        </div>
        <!-- End Payment Method Card -->
      </div>

      <!-- Order Summary -->
      <div class="md:col-span-12 lg:col-span-4 col-span-12">
        <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
          <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">ORDER SUMMARY</div>
          <div class="flex justify-between mb-2 font-bold">
            <span>Subtotal</span>
            <span>{{ Number::currency($grand_total, 'BDT') }}</span>
          </div>

          @if($payment_method === 'cod' && $advance_amount > 0)
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

        <button type="submit" class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
          <span wire:loading.remove>Place Order</span>
          <span wire:loading>Processing...</span>
        </button>
      </div>
      <!-- End Order Summary -->
    </div>
  </form>
</div>

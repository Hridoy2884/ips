<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class CheckoutPage extends Component
{
    use WithFileUploads;

    public $first_name, $last_name, $phone, $city, $street_address, $zip_code, $district;
    public $payment_method;
    public $transaction_id;
    public $payment_proof;

    public $advance_amount;   // 15% COD advance
    public $total_with_fee;   // for bkash/nagad/rocket

    public function mount()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        if (count($cart_items) === 0) {
            return redirect('/products');
        }

        $grand_total = CartManagement::calculateGrandTotal($cart_items);

        // COD 15% advance
        $this->advance_amount = $this->calculateAdvanceAmount($cart_items);

        // For bKash/Nagad/Rocket add 1.85% fee
        $this->total_with_fee = $grand_total + ($grand_total * 0.0185);
    }

    protected function rules()
    {
        $rules = [
            'first_name'      => 'required',
            'last_name'       => 'required',
            'phone'           => 'required',
            'city'            => 'required',
            'street_address'  => 'required',
            'zip_code'        => 'required',
            'district'        => 'required',
            'payment_method'  => 'required|in:cod,bkash,nagad,rocket,bank',
        ];

        // COD requires advance transaction id
        if ($this->payment_method === 'cod') {
            $rules['transaction_id'] = 'required|string|max:255';
        }

        // Online payment methods
        if (in_array($this->payment_method, ['bkash', 'nagad', 'rocket', 'bank'])) {
            $rules['transaction_id'] = 'required|string|max:255';
            $rules['payment_proof'] = 'nullable|image|max:2048';
        }

        return $rules;
    }

    public function calculateAdvanceAmount(array $cart_items): float
    {
        $total = 0;
        foreach ($cart_items as $item) {
            $total += $item['unit_amount'] * $item['quantity'] * 0.15; // 15%
        }
        return round($total, 2);
    }

    public function placeOrder()
    {
        $this->validate();

        $cart_items = CartManagement::getCartItemsFromCookie();

        $order = new Order();
        $order->user_id        = auth()->user()->id;
        $order->grand_total    = CartManagement::calculateGrandTotal($cart_items);
        $order->advance_amount = $this->payment_method === 'cod' ? $this->advance_amount : 0;
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->transaction_id = $this->transaction_id;

        if (in_array($this->payment_method, ['bkash','nagad','rocket','bank']) && $this->payment_proof) {
            $order->payment_proof = $this->payment_proof->store('payment_proofs', 'public');
        }

        $order->currency = 'BDT';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by ' . auth()->user()->name;
        $order->save();

        // Save address
        $address = new Address();
        $address->order_id = $order->id;
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->city = $this->city;
        $address->street_address = $this->street_address;
        $address->zip_code = $this->zip_code;
        $address->district = $this->district;
        $address->save();

        // Save order items
        $order->orderItems()->createMany($cart_items);

        CartManagement::clearCartItems();

        Mail::to(auth()->user()->email)->send(new OrderPlaced($order));

        return redirect()->route('success', ['transaction_id' => $order->transaction_id]);
    }

    public function render()
    {
        $cart_items  = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);

        return view('livewire.checkout-page', [
            'cart_items'      => $cart_items,
            'grand_total'     => $grand_total,
            'advance_amount'  => $this->advance_amount,
            'total_with_fee'  => $this->total_with_fee,
        ]);
    }
}

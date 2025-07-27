<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\Attributes\Title;
use Stripe\Stripe;
use Stripe\Checkout\Session;

#[Title('CheckoutPage -Jui')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $city;
    public $street_address;
    public $zip_code;
    public $district;
    public $payment_method;

    public function mount(){
        $cart_items = CartManagement::getCartItemsFromCookie();
        if (count($cart_items) == 0) {
            return redirect('/products');
        }

    }

    public function placeOrder(){
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'street_address' => 'required',
            'zip_code' => 'required',
            'district' => 'required',
            'payment_method' => 'required'
        ]);

        // Here you can add the logic to place the order
        // For example, save the order details to the database

        // session()->flash('message', 'Order placed successfully!');

        $cart_items = CartManagement::getCartItemsFromCookie();

        $line_items = [];
        foreach ($cart_items as $item) {
            $line_items[] = [
               
                'price_data' =>[
                    'currency'=>'BDT',
                    'unit_amount'=>$item['unit_amount'] * 100,
                    'product_data'=>[
                        'name'=>$item['name'],
                    ]

                ],
                'quantity'=>$item['quantity'],
            ];
        }

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->currency = 'BDT';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by'.auth()->user()->name;

        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->city = $this->city;
        $address->street_address = $this->street_address;
        $address->zip_code = $this->zip_code;
        $address->district = $this->district;

        $redirect_url ='';


       if($this->payment_method == 'stripe'){
       Stripe::setApiKey(env('STRIPE_SECRET'));
       $sessionCheckout = Session::create([
        'payment_method_types' => ['card'],
        'customer_email' => auth()->user()->email,
        'line_items' => $line_items,
        'mode' => 'payment',
        'success_url' => route('success').'?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('cancel'),



       ]);
         $redirect_url = $sessionCheckout->url;




       }

       else {
        $redirect_url = route('success');


       }
       $order->save();
       $address -> order_id= $order->id;
         $address->save();
         $order->orderItems()->createMany($cart_items);
            CartManagement::clearCartItems();

        // Send email to user
       
        Mail::to(request()->user())->send(new OrderPlaced($order));
   

     
        // Mail::to($user->email)->send(new OrderPlaced($order));

        // Mail::to(auth()->user()->email)->send(new OrderPlaced($order));
        // Send email to admin
        // Mail::to(env('ADMIN_EMAIL'))->send(new OrderPlaced($order));


            return redirect($redirect_url);






       
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        return view('livewire.checkout-page',[
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
        ]);
    }
}

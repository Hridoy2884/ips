<?php

namespace App\Livewire;

use Livewire\Component;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Livewire\Attributes\Title;


#[Title('CartPage -JUI')]
class CartPage extends Component
{
    public $cart_items =[];
    public $grand_total;


public function mount()
{
    $cart_items = CartManagement::getCartItemsFromCookie();

    $this->cart_items = collect($cart_items)->map(function ($item) {
        $productId = is_array($item) ? $item['product_id'] : $item;

        $product = \App\Models\Product::find($productId);

        if (!$product) {
            // Product not found, skip this item
            return null;
        }

        return [
            'product_id'   => $product->id,
            'name'         => $product->name,
            'image'        => $product->images[0] ?? null,
            'unit_amount'  => $item['unit_amount'],
            'quantity'     => $item['quantity'],
            'total_amount' => $item['total_amount'],
        ];
    })
    ->filter() // remove null values from map
    ->values()
    ->toArray();

    $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
}

    public function removeItem($product_id)
    {
        // Remove the product from the cart
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);

        $this->dispatch('update-cart-count', total_count:count($this->cart_items))->to(Navbar::class);
        
        
        
    }

    public function increaseQty($product_id)
    {
        // Increase the quantity of the product in the cart
        $this->cart_items = CartManagement::incrementQuantityTocartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);

       
    }

    
    public function decreaseQty($product_id)
    {
        // Increase the quantity of the product in the cart
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);

    
    }



    public function render()
    {
        return view('livewire.cart-page');
    }
}

<?php

namespace App\Livewire\Partials;

use App\Helpers\CartManagement;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use Livewire\Attributes\On;

class Navbar extends Component
{
    public $total_count = 0;

    // Listen for cart update event
    // protected $listeners = ['update-cart-count' => 'updateCartCount'];

    public function mount()
    {
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
    }

    // Update cart count when event is received
    #[On('update-cart-count')]
    public function updateCartCount($total_count)
    {
        $this->total_count = $total_count;
    }
   

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}

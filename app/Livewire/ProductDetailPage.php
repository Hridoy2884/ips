<?php
namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;


#[Title('ProductDetailPage -Jui')]
class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;
    public $loading = false;  // Added loading state

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function increaseQty()
    {
        $this->quantity++;
    }

    public function decreaseQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart($product_id)
    {
        // Set loading state to true while the process is happening
        $this->loading = true;

        // Get the total count from CartManagement (assuming it returns the updated cart count)
        $total_count = CartManagement::addItemToCartWithQty($product_id,$this->quantity);
    
        // Dispatch event to update the cart count in Navbar
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
        
        // Set loading state to false after operation is complete
        $this->loading = false;

        // You can add a success message or alert if necessary
    }

    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}
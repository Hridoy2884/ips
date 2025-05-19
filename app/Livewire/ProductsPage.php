<?php

namespace App\Livewire;

use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Helpers\CartManagement;
use Illuminate\Support\Facades\Cookie;

// use Jantinnerezo\LivewireAlert\Traits\LivewireAlert;

use Livewire\Attributes\Title;

#[Title('ProductsPage -Gadgety')]

class ProductsPage extends Component
{
    
    // use LivewireAlert;
   use WithPagination;
    #[Url]
    public $selected_categories =[];
    #[Url]
    public $selected_brands = [];

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;
    #[Url]

    public $price_range = 30000;

    #[Url]
    public $sort = 'latest';
 


//add product to cart method



public function addToCart($product_id)
{
    // Get existing cart items from cookie
    $total_count = CartManagement::addItemToCart($product_id);


    // // Add the product ID to the cart
    // $items[] = $product_id;

    // // Save updated cart back to the cookie
    // Cookie::queue('cart_items', json_encode($items), 60 * 24 * 30); // 30 days

    // Dispatch event with updated count
    $this->dispatch('update-cart-count', total_count:$total_count)->to(Navbar::class);

    // Show success message with LivewireAlert

    // $this->alert('success', 'Product added to the cart', [
    //     'position' => 'bottom-end',
    //     'timer' => 1500,
    //     'toast' => true,
     
    //     'icon' => 'success',
    // ]);
}




    public function render()
    {
        $productsQuery = Product::query()->where('is_active', 1);

        if(!empty($this->selected_categories)){
            $productsQuery->whereIn('category_id', $this->selected_categories);
        }

        if(!empty($this->selected_brands)){
            $productsQuery->whereIn('brand_id', $this->selected_brands);
        }

        if($this->featured){
            $productsQuery->where('is_featured', 1);
        }

        if($this->featured){
            $productsQuery->where('on_sale', 1);
        }

        if($this->price_range){
            $productsQuery->whereBetween('price', [0, $this->price_range]);
        }
        if($this->sort == 'latest'){
            $productsQuery->latest();
        }

        if($this->sort == 'price'){
            $productsQuery->orderBy('price');
        }



         
         
        return view('livewire.products-page', [
            'products' => $productsQuery->paginate(10),
            'brands'=> Brand::where('is_active', true)->get(['id', 'name', 'slug']),
            'categories'=> Category::where('is_active', true)->get(['id', 'name', 'slug']),

        ]);
    }
}

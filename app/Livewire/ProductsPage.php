<?php

namespace App\Livewire;

use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Helpers\CartManagement;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;


#[Title('ProductsPage - Jui')]
class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public $selected_categories = [];

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

    #[Url]
    public $search = ''; // For search input binding

    // Reset pagination when search input is updated
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Add product to cart method
    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        // Optionally use LivewireAlert if enabled
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

        if (!empty($this->selected_categories)) {
            $productsQuery->whereIn('category_id', $this->selected_categories);
        }

        if (!empty($this->selected_brands)) {
            $productsQuery->whereIn('brand_id', $this->selected_brands);
        }

        if ($this->featured) {
            $productsQuery->where('is_featured', 1);
        }

        if ($this->on_sale) {
            $productsQuery->where('on_sale', 1);
        }

        if ($this->price_range) {
            $productsQuery->whereBetween('price', [0, $this->price_range]);
        }

        if (!empty($this->search)) {
            $productsQuery->where('name', 'like', '%' . $this->search . '%');
            // OR case-insensitive:
            // $productsQuery->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->search) . '%']);
        }

        if ($this->sort == 'latest') {
            $productsQuery->latest();
        } elseif ($this->sort == 'price') {
            $productsQuery->orderBy('price');
        }

        return view('livewire.products-page', [
            'products' => $productsQuery->paginate(10),
            'brands' => Brand::where('is_active', true)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', true)->get(['id', 'name', 'slug']),
        ]);
    }

    //buy now button action
public function buyNow($product_id)
{
    // Clear existing cart first (optional, or you can customize)
    CartManagement::clearCartItems();

    // Add only this product to cart
    CartManagement::addItemToCart($product_id);

    // Redirect to checkout page
    return redirect()->route('checkout');
}


}

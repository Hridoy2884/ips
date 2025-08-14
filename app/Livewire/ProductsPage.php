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

    // SEO properties
    public $seoTitle;
    public $seoDescription;
    public $seoKeywords;

    public function mount()
    {
        // Default SEO for products page
        $this->seoTitle = 'Products - Jui Power Digital Ips';
        $this->seoDescription = 'Explore our latest collection of products at Jui Power Digital Ips. Find the best deals on featured and on-sale items.';
        $this->seoKeywords = 'Jui, products, IPS, battery, inverter,solar,solar panel, electronics';
    }

    // Reset pagination when search input is updated
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // Optionally update SEO when categories are selected
    public function updatedSelectedCategories()
    {
        $this->resetPage();
        $categoryNames = Category::whereIn('id', $this->selected_categories)->pluck('name')->toArray();
        if (!empty($categoryNames)) {
            $this->seoTitle = implode(', ', $categoryNames) . ' - Products';
            $this->seoDescription = 'Showing products in categories: ' . implode(', ', $categoryNames);
        } else {
            $this->seoTitle = 'Products - Jui Power Digital Ips';
            $this->seoDescription = 'Explore our latest collection of products at Jui Power Digital Ips.';
        }
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

    // Buy now button action
    public function buyNow($product_id)
    {
        // Clear existing cart first (optional)
        CartManagement::clearCartItems();

        // Add only this product to cart
        CartManagement::addItemToCart($product_id);

        // Redirect to checkout page
        return redirect()->route('checkout');
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
}

<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Home Page-Gadgety')]
class HomePage extends Component
{
    public function render()
    {
        $brands = Brand::where('is_active', true)
            ->orderBy('name')
            ->get();
            $categories = Category::where('is_active', 1)
            ->orderBy('name')
            ->get();
        return view('livewire.home-page',[
            'brands'=>$brands,
            'categories'=>$categories,
        ]);
    }
}

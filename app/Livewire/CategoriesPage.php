<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Category;


#[Title('CategoriesPage-Jui')]
class CategoriesPage extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', 1)
        ->orderBy('name')
        ->get();
        return view('livewire.categories-page',[
            'categories'=>$categories,
        ]);
    }
}

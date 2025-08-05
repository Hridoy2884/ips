<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Review;
use Livewire\WithPagination;

class ReviewForm extends Component
{
     use WithPagination;
    public $name, $email, $comment, $rating = 0;

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'name' => $this->name,
            'email' => $this->email,
            'comment' => $this->comment,
            'rating' => $this->rating,
        ]);

        session()->flash('success', 'Thank you for your review!');
        $this->reset(['name', 'email', 'comment', 'rating']);
    }

    public function render()
    {
        $reviews = Review::latest()->take(10)->get(); // Show recent 10

        return view('livewire.review-form', compact('reviews'));
    }
}

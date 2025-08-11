<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Policy;

class PolicyPage extends Component
{
    public $slug;
    public $policy;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->policy = Policy::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.policy-page', [
            'policy' => $this->policy
        ]);
    }
}

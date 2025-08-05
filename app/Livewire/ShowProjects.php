<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;

class ShowProjects extends Component
{
    public function render()
    {
        return view('livewire.show-projects', [
            'projects' => Project::latest()->take(8)->get()
        ]);
    }
}

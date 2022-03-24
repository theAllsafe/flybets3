<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowPosts extends Component
{
    public $name = 'Osama';

    public function render()
    {
        return view('livewire.show-posts');
    }
}

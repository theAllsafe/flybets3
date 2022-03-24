<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $user;
    public $countries;

    public function render()
    {
        return view('livewire.counter');
    }
}

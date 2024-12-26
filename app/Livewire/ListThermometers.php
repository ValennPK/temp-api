<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Thermometer;
use App\Models\User;


class ListThermometers extends Component
{
    public $thermometers, $user;

    public function mount() {
        $user = auth()->user();
        
        $this->thermometers = Thermometer::all();
    }

    public function render()
    {
        return view('livewire.list-thermometers');
    }
}

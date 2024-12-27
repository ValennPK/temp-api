<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;




class ListThermometers extends Component
{
    public $thermometers, $user;

    public function mount() {
        $this->user = Auth::user();


        // if ($user->hasRole('admin')) {
        //     $this->thermometers = Thermometer::all();
        // }
        

    }

    public function render()
    {
        return view('livewire.list-thermometers');
    }
}

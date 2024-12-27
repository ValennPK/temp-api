<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Thermometer;




class ListThermometers extends Component
{
    public $thermometers, $user, $role;

    public function mount() {

        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $this->role = 'Admin';
            $this->thermometers = Thermometer::all();
        }
        

    }

    public function render()
    {
        return view('livewire.list-thermometers');
    }
}

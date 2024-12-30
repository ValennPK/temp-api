<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Thermometer;
use App\Models\ThermometerPermission;
use Illuminate\Support\Facades\DB;




class ListThermometers extends Component
{
    public $thermometers, $user, $role;

    public function mount() {

        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $this->role = 'Admin';
            $this->thermometers = Thermometer::all();
        }

        else {
            $this->role = 'User';
            $thermometer_ids = ThermometerPermission::where('user_id', Auth::user()->id)->pluck('thermometer_id');
        
            foreach ($thermometer_ids as $thermometer_id) {
                $this->thermometers[] = Thermometer::where('id', $thermometer_id)->first();
            }
        }
        

    }

    public function render()
    {
        return view('livewire.list-thermometers');
    }
}

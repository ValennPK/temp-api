<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Temperature;

class TemperatureForm extends Component
{  
    public $port1;
    public $port2;
    public $port3;
    public $port4;
    public $port5;
    public $port6;
    public $port7;
    public $port8;

    protected $rules = [
        'port1' => 'required|numeric',
        'port2' => 'required|numeric',
        'port3' => 'required|numeric',
        'port4' => 'required|numeric',
        'port5' => 'required|numeric',
        'port6' => 'required|numeric',
        'port7' => 'required|numeric',
        'port8' => 'required|numeric',
    ];

    public function submit()
    {
        $this->validate();

        $temperature = new Temperature();
        $temperature->port1 = $this->port1;
        $temperature->port2 = $this->port2;
        $temperature->port3 = $this->port3;
        $temperature->port4 = $this->port4;
        $temperature->port5 = $this->port5;
        $temperature->port6 = $this->port6;
        $temperature->port7 = $this->port7;
        $temperature->port8 = $this->port8;
        $temperature->save();

        session()->flash('message', 'Temperature created successfully.');
    }
}

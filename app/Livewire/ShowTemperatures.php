<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ShowTemperatures extends Component
{
    public $thermometerName;
    public $data;
    public $message;
    public $showList = false;

    public function mount($thermometerName) {

        $this->thermometerName = $thermometerName;

        if (Schema::hasTable($thermometerName)) {
            $this->data = DB::table($thermometerName)->orderBy('created_at', 'desc')->get();
        } else {
            $this->message = 'Thermometer not found';
            $this->data = [];
        }
    }

    public function toggleList() {
        $this->showList = !$this->showList;
    }
    
    public function render()
    {
        return view('livewire.show-temperatures', [
            'data' => $this->data
        ]);
    }
}

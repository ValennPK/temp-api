<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ShowThermometer extends Component
{
    public $thermometer;
    public $data;

    public function mount($thermometer)
    {
        $this->thermometer = $thermometer;

        if (DB::getSchemaBuilder()->hasTable($this->thermometer)) {
            $this->data = DB::table($this->thermometer)->get();
        } else {
            abort(404, "The table '{$this->thermometer}' does not exist.");
        }
    }

    public function render()
    {
        return view('livewire.show-thermometer', [
            'thermometer' => $this->thermometer,
            'data' => $this->data
        ]);
    }
}

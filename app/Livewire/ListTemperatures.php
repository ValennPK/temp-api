<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ListTemperatures extends Component
{
    public $thermometerName;
    public $data;
    public $message;
    public $recordsPerPage = 100;
    public $startDate;
    public $endDate;
    public $startTimeFilter;
    public $endTimeFilter;
    public $showList = false;


    public function mount($thermometerName)
    {
        $this->thermometerName = $thermometerName;

        if (Schema::hasTable($thermometerName)) {
            $this->fetchData();
        } else {
            $this->message = 'Thermometer not found';
            $this->data = [];
        }
    }

    public function UpdateList()
    {
        $this->fetchData();
    }

    public function toggleList()
    {
        $this->showList = !$this->showList;
    }

    public function fetchData()
    {
        $this->recordsPerPage = max(1, min(100, $this->recordsPerPage));

        $query = DB::table($this->thermometerName)
            ->orderBy('created_at', 'desc');

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        if ($this->startTimeFilter) {
            $query->whereTime('created_at', '>=', $this->startTimeFilter);
        }

        if ($this->endTimeFilter) {
            $query->whereTime('created_at', '<=', $this->endTimeFilter);
        }

        $query->orderBy('created_at', 'desc');

        $this->data = $query->limit($this->recordsPerPage)->get();
    }

    public function render()
    {
        return view('livewire.list-temperatures');
    }
}

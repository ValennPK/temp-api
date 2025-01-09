<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class TestTemperatures extends Component
{
    use WithPagination;

    public $thermometerName;
    public $data;
    public $message;
    public $recordsPerPage = 25;
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

        @dd($query);

        return $query->paginate(25);
    }
    

    public function render()
    {
        $data = $this->fetchData();
        return view('livewire.test-temperatures', ['data' => $data]);
    }
}

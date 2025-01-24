<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ThermometerPermission;
use App\Models\Thermometer;

class ListTemperatures extends Component
{
    use WithPagination;

    public $thermometerName;
    public $hasPermission = false;
    public $data;
    public $message;
    public $recordsPerPage = 10;
    public $startDate;
    public $endDate;
    public $startTimeFilter;
    public $endTimeFilter;
    public $showList = true;


    public function mount($thermometerName)
    {
        if (Auth::check()) {
            if (Schema::hasTable($thermometerName)) {
                if (Auth::user()->hasRole('admin')) {
                    $this->thermometerName = $thermometerName;
                    $this->hasPermission = true;
                }

                else {
                    $user_permissions = ThermometerPermission::where('user_id', Auth::user()->id)->pluck('thermometer_id');
                    $thermometer = Thermometer::where('username', $thermometerName)->pluck('id')->first();
                
                    if ($user_permissions->contains($thermometer)) {
                        $this->thermometerName = $thermometerName;
                        $this->hasPermission = true;
                    }
                    else {
                        $this->message = 'You do not have permission to view this thermometer';
                        $this->hasPermission = false;
                    }
                }
            }

            else {
                $this->message = 'Thermometer not found';
                $this->hasPermission = false;
            }
        }

        else {
            $this->message = 'You are not logged in';
            $this->hasPermission = false;
        }

    }


    public function toggleList()
    {
        $this->showList = !$this->showList;
    }

    public function fetchData()
    {
        $this->recordsPerPage = max(10, min(25, $this->recordsPerPage));

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

        return $query;
    }

    public function render()
    {
        if (!$this->hasPermission) {
            return view('livewire.list-temperatures', [
                'message' => 'Thermometer not found',
                'paginatedData' => null
            ]);
        }
        
        $paginatedData = $this->fetchData()->paginate($this->recordsPerPage);
    
        return view('livewire.list-temperatures', [
            'paginatedData' => $paginatedData,
            'message' => null 
        ]);
    }
}


// para modificar la cantidad de registros desde la vista

// <div class="mb-3 d-flex align-items-center">
// <label for="recordsPerPage" class="form-label me-2"> Cantidad de registros:</label>
// <input type="number" wire:model="recordsPerPage" id="recordsPerPage" class="form-control me-2" min="10" max="25"  style="width: 100px;" placeholder="Max(100)">
// <button wire:click="UpdateList" class="btn btn-primary mb-3">
//     Actualizar
// </button>
// </div>
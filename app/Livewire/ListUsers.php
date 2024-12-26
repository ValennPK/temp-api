<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class ListUsers extends Component
{
    public $users;

    public function mount() {
        $this->users = User::all();
    }
    public function render()
    {
        return view('livewire.list-users');
    }
}

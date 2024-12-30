<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ListUsers extends Component
{
    public $users;

    public function mount() {
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $this->users = User::all();
        }


    }
    public function render()
    {
        return view('livewire.list-users');
    }
}

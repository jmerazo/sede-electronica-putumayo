<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SidebarMenu extends Component
{
    public $modules = [];

    public function mount()
    {
        if (Auth::check()) {
            $this->modules = Auth::user()->modules;
        }
    }

    public function render()
    {
        return view('livewire.sidebar-menu', ['modules' => $this->modules]);
    }
}
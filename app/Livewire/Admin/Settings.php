<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Settings extends Component
{
    public function render()
    {
        return view('admin.livewire.pages.settings')
            ->extends('admin.livewire.dashboard')
            ->section('content');
    }
}

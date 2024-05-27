<?php

namespace App\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.pages.profile')
            ->extends('livewire.layouts.dashboard')
            ->section('content');
    }
}

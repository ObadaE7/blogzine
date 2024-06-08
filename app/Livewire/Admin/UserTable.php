<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\{Component,WithPagination};

class UserTable extends Component
{
    use WithPagination;

    public function render()
    {
        $headers = ['Avatar', 'Name', 'Email', 'Actions'];
        $rows = User::paginate(5);
        return view('admin.livewire.pages.user-table', compact('headers', 'rows'))
            ->extends('admin.livewire.dashboard')
            ->section('content');
    }
}

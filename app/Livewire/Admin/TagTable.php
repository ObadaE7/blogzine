<?php

namespace App\Livewire\Admin;

use App\Models\Tag;
use Livewire\{Component,WithPagination};

class TagTable extends Component
{
    use WithPagination;

    public function render()
    {
        $headers = ['Id', 'Name', 'Slug', 'Actions'];
        $rows = Tag::paginate(5);

        return view('admin.livewire.pages.tag-table', compact('headers', 'rows'))
            ->extends('admin.livewire.dashboard')
            ->section('content');
    }
}

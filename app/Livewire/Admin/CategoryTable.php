<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\{Component,WithPagination};

class CategoryTable extends Component
{
    use WithPagination;

    public function render()
    {
        $headers = ['Image', 'Id', 'Name', 'Slug', 'Actions'];
        $rows = Category::paginate(5);

        return view('admin.livewire.pages.category-table', compact('headers', 'rows'))
            ->extends('admin.livewire.dashboard')
            ->section('content');
    }
}

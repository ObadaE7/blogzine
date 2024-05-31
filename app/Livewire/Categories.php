<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public function render()
    {
        $categories = $this->getAllCategory();
        return view('livewire.categories', compact('categories'))
            ->extends('livewire.layouts.home')
            ->section('content');
    }

    public function getAllCategory()
    {
        return Category::paginate(6);
    }
}

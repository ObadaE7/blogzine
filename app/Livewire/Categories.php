<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\{Component, WithPagination};

class Categories extends Component
{
    use WithPagination;

    #[Title('Categories')]
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

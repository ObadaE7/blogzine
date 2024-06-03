<?php

namespace App\Livewire;

use App\Models\Category as ModelsCategory;
use Livewire\Attributes\Title;
use Livewire\{Component, WithPagination};

class Category extends Component
{
    use WithPagination;

    public $category;
    public $posts;

    #[Title('Category')]
    public function render()
    {
        return view('livewire.category')
            ->extends('livewire.layouts.home')
            ->section('content');
    }

    public function mount($slug)
    {
        $this->category = ModelsCategory::where('slug', $slug)->first();
        $this->posts = $this->category->posts()->get();
    }
}

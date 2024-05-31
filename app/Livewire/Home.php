<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = $this->getSectionOneData();
        $postsSecTwo = $this->getSectionTwoData();
        $categoriesSecTwo = $this->getFiveCategories();
        $categories = $this->getCategories();
        $colorClasses = getClassColors();
        $color = $colorClasses[array_rand($colorClasses)];
        return view('livewire.home', compact('posts', 'color', 'postsSecTwo', 'categoriesSecTwo', 'categories'))
            ->extends('livewire.layouts.home')
            ->section('content');
    }

    public function getSectionOneData()
    {
        return Post::isVisible()->latest()->take(3)->get();
    }

    public function getSectionTwoData()
    {
        return Post::isVisible()->inRandomOrder()->latest()->paginate(4);
    }

    public function getFiveCategories()
    {
        return Category::inRandomOrder()->take(5)->get();
    }

    public function getCategories()
    {
        return Category::all();
    }
}

<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $posts = $this->getSectionOneData();
        $colorClasses = getClassColors();
        $color = $colorClasses[array_rand($colorClasses)];

        return view('livewire.home', compact('posts', 'color'))
            ->extends('livewire.layouts.home')
            ->section('content');
    }

    public function getSectionOneData()
    {
        return Post::inRandomOrder()->take(3)->get();
    }
}

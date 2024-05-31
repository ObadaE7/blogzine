<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = $this->getAllPost();
        return view('livewire.posts', compact('posts'))
            ->extends('livewire.layouts.home')
            ->section('content');
    }

    public function getAllPost()
    {
        return Post::paginate(5);
    }
}

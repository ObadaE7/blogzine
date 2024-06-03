<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\{Component, WithPagination};

class Posts extends Component
{
    use WithPagination;

    #[Title('Posts')]
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

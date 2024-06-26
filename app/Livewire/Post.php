<?php

namespace App\Livewire;

use App\Models\Post as ModelsPost;
use Livewire\Attributes\Title;
use Livewire\Component;

class Post extends Component
{
    public $post;

    #[Title('Post')]
    public function render()
    {
        return view('livewire.post')
            ->extends('livewire.layouts.home')
            ->section('content');
    }

    public function mount($slug)
    {
        $this->post = ModelsPost::where('slug', $slug)->first();
    }
}

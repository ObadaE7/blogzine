<?php

namespace App\Livewire;

use App\Models\Tag as ModelsTag;
use Livewire\Attributes\Title;
use Livewire\{Component, WithPagination};

class Tag extends Component
{
    use WithPagination;

    public $tag;
    public $posts;

    #[Title('Posts tagged')]
    public function render()
    {
        return view('livewire.tag')
            ->extends('livewire.layouts.home')
            ->section('content');
    }

    public function mount($slug)
    {
        $this->tag = ModelsTag::where('slug', $slug)->first();
        $this->posts = $this->tag->posts()->get();
    }
}

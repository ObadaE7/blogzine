<?php

namespace App\Livewire;

use App\Models\{Category, Post, Tag};
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Livewire\Forms\CreatePostForm;
use Exception;
use Illuminate\Support\Facades\Log;

class CreatePost extends Component
{
    use WithFileUploads;

    public CreatePostForm $form;

    public function render()
    {
        $this->loadData();
        return view('livewire.pages.create-post')
            ->extends('livewire.layouts.dashboard')
            ->section('content');
    }

    public function updatedFormTitle()
    {
        if (empty($this->form->title)) {
            $this->form->slug = '';
        } else {
            $this->form->validateOnly('title');
            $this->form->slug = str()->slug($this->form->title);
        }
    }

    #[On('quill-updated-value')]
    public function updatedFormContent($value)
    {
        $this->form->content = $value;
    }

    public function create()
    {
        $validated = $this->form->validate();
        $user_id = auth()->user()->id;
        $validated['user_id'] = $user_id;
        $validated['image'] = $this->handleImageUpload($validated['image'] ?? null);
        try {
            $post = Post::create($validated);
            $post->categories()->attach($this->form->category_id);
            foreach ($this->form->tag_ids as $tag) {
                $post->tags()->attach($tag);
            }
            session()->flash('success', trans('The post was created successfully'));
            $this->form->reset();
            $this->dispatch('reset-quill-content');
            $this->dispatch('reset-select2');
        } catch (Exception $e) {
            Log::error('[createPost]: ' . $e->getMessage());
            session()->flash('error', trans('Post creation failed'));
        }
    }

    private function handleImageUpload($image)
    {
        return $image ? $image->store('posts', 'public') : null;
    }

    private function loadData()
    {
        $this->form->categories = Category::all();
        $this->form->tags = Tag::all();
        $this->form->statuses = ['draft', 'published'];
    }
}

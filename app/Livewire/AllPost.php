<?php

namespace App\Livewire;

use App\Models\{Category, Post, Tag};
use App\Livewire\Forms\CreatePostForm;
use App\Traits\{FilterTrait, ModalTrait};
use Livewire\{Component, WithFileUploads, WithPagination};
use Exception;
use Illuminate\Support\Facades\{Storage, Log};
use Livewire\Attributes\On;

class AllPost extends Component
{
    use WithPagination, WithFileUploads, FilterTrait, ModalTrait;

    public CreatePostForm $form;
    public $postId;
    public $existingImage;

    public function render()
    {
        $posts = $this->getPostsData();
        return view('livewire.pages.all-post', compact('posts'))
            ->extends('livewire.layouts.dashboard')
            ->section('content');
    }

    public function mount()
    {
        $this->form->categories = Category::all();
        $this->form->tags = Tag::all();
        $this->form->statuses = ['draft', 'published'];
        $this->searchBy = 'title';
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->postId = $post->id;
        $this->existingImage = $post->image;
        $this->form->title = $post->title;
        $this->form->subtitle = $post->subtitle;
        $this->form->slug = $post->slug;
        $this->form->content = $post->content;
        $this->form->status = $post->status;
        $this->dispatch('fill-quill-content', $this->form->content);
        $this->form->category_id = $post->categories->pluck('id')->first();
        $this->form->tag_ids = $post->tags->pluck('id')->toArray();
    }

    public function update($id)
    {
        $validated = $this->form->validate();
        $user_id = auth()->user()->id;
        $validated['user_id'] = $user_id;

        if ($validated['image']) {
            if ($this->existingImage) {
                Storage::disk('public')->delete($this->existingImage);
            }
            $validated['image'] = $this->handleImageUpload($validated['image'] ?? null);
        }

        try {
            $post = Post::findOrFail($id);
            $post->update($validated);
            $post->categories()->sync($this->form->category_id);
            $post->tags()->sync($this->form->tag_ids);
            session()->flash('success', trans('The post was updated successfully'));
            $this->form->reset();
            $this->dispatch('reset-quill-content');
            $this->closeModal('modalEdit');
        } catch (Exception $e) {
            Log::error('[updatePost]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update post'));
        }
    }

    public function delete($id)
    {
        try {
            Post::findOrFail($id)->delete();
            session()->flash('success', trans('The post has been successfully deleted'));
            $this->closeModal('modalDelete');
        } catch (Exception $e) {
            Log::error('[deletePost]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to delete post'));
        }
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

    private function getPostsData()
    {
        return Post::where('user_id', auth()->user()->id)
            ->where($this->searchBy, 'like', "%{$this->search}%")
            ->orderBy($this->orderBy, $this->orderDir)
            ->paginate($this->perPage);
    }

    private function handleImageUpload($image)
    {
        return $image ? $image->store('posts', 'public') : null;
    }

    public function columns()
    {
        return ['id', 'title', 'subtitle', 'created_at'];
    }

    public function perPage()
    {
        return [3, 5, 10, 20];
    }

    public function resetFilters()
    {
        $this->reset(['search', 'searchBy', 'perPage', 'orderBy', 'orderDir']);
        $this->dispatch('urlReset', route('dashboard.post.index'));
    }
}

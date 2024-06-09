<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Traits\FilterTrait;
use App\Traits\ModalTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\{Component, WithPagination};

class PostTable extends Component
{
    use WithPagination, ModalTrait, FilterTrait;

    public $postId;
    public $columns;
    public $perPages;

    public function render()
    {
        $headers = ['Image', 'Titles', 'Status', 'Actions'];
        $rows = Post::where($this->searchBy, 'like', "%{$this->search}%")
            ->orderBy($this->orderBy, $this->orderDir)
            ->paginate($this->perPage);
        $this->columns = ['title', 'subtitle', 'status'];
        $this->perPages = [5, 10, 20, 50];

        $inTrashed = Post::onlyTrashed()->count();
        $published = Post::where('status','published')->count();
        $draft = Post::where('status','draft')->count();

        return view('admin.livewire.pages.post-table', compact('headers', 'rows', 'inTrashed', 'published', 'draft'))
            ->extends('admin.livewire.dashboard')
            ->section('content');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        try {
            if ($post) {
                $post->delete();
                session()->flash('success', trans('The post has been deleted successfully'));
                $this->closeModal('deleteModal');
            } else {
                session()->flash('error', trans('Post not found'));
            }
        } catch (Exception $e) {
            Log::error('[deletePost]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to delete post'));
        }
    }

    public function resetFilters()
    {
        $this->reset(['search', 'searchBy', 'perPage', 'orderBy', 'orderDir']);
        $this->dispatch('urlReset', route('admin.table.tags'));
    }
}

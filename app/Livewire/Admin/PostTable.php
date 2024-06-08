<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Traits\ModalTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\{Component, WithPagination};

class PostTable extends Component
{
    use WithPagination, ModalTrait;

    public $postId;

    public function render()
    {
        $headers = ['Image', 'Titles', 'Status', 'Actions'];
        $rows = Post::paginate(5);

        return view('admin.livewire.pages.post-table', compact('headers', 'rows'))
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
}

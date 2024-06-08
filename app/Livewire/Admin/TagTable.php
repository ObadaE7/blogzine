<?php

namespace App\Livewire\Admin;

use App\Models\Tag;
use App\Traits\ModalTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\{Component, WithPagination};

class TagTable extends Component
{
    use WithPagination, ModalTrait;

    public $tagId;

    public function render()
    {
        $headers = ['Id', 'Name', 'Slug', 'Actions'];
        $rows = Tag::paginate(5);

        return view('admin.livewire.pages.tag-table', compact('headers', 'rows'))
            ->extends('admin.livewire.dashboard')
            ->section('content');
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        try {
            if ($tag) {
                $tag->delete();
                session()->flash('success', trans('The tag has been deleted successfully'));
                $this->closeModal('deleteModal');
            } else {
                session()->flash('error', trans('Tag not found'));
            }
        } catch (Exception $e) {
            Log::error('[deleteTag]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to delete tag'));
        }
    }
}

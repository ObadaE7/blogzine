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
    public $name;
    public $slug;

    public function render()
    {
        $headers = ['Id', 'Name', 'Slug', 'Actions'];
        $rows = Tag::paginate(5);

        return view('admin.livewire.pages.tag-table', compact('headers', 'rows'))
            ->extends('admin.livewire.dashboard')
            ->section('content');
    }

    public function create()
    {
        $validated =   $this->validate([
            'name' => 'required|string|min:3|max:25|unique:tags,name,',
            'slug' => 'required|string|unique:tags,slug,',
        ]);

        try {
            Tag::create($validated);
            session()->flash('success', trans('The tag has been created successfully'));
            $this->resetField();
            $this->closeModal('createModal');
        } catch (Exception $e) {
            Log::error('[createTag]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to create tag'));
        }
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $this->tagId = $tag->id;
        $this->name = $tag->name;
        $this->slug = $tag->slug;
    }

    public function updatedName()
    {
        $this->slug = str()->slug($this->name);
    }

    public function update($id)
    {
        $tag = Tag::findOrFail($id);
        $validated =   $this->validate([
            'name' => 'required|string|min:3|max:25|unique:tags,name,' . $tag->id,
            'slug' => 'required|string|unique:tags,slug,' . $tag->id,
        ]);

        try {
            $tag->update($validated);
            session()->flash('success', trans('The tag has been updated successfully'));
            $this->closeModal('editModal');
        } catch (Exception $e) {
            Log::error('[updateTag]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update tag'));
        }
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

    public function resetField()
    {
        $this->reset();
    }
}

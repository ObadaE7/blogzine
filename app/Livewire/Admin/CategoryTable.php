<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Traits\FilterTrait;
use App\Traits\ModalTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\{Component, WithPagination};
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CategoryTable extends Component
{
    use WithPagination, WithFileUploads, ModalTrait, FilterTrait;

    public $categoryId;
    public $image;
    public $existingImage;
    public $name;
    public $slug;
    public $description;
    public $columns;
    public $perPages;

    public function render()
    {
        $headers = ['Image', 'Id', 'Name', 'Slug', 'Posts', 'Actions'];
        $rows = Category::withCount('posts')
            ->when($this->searchBy === 'posts_count', function ($query) {
                $query->having('posts_count', 'like', "%{$this->search}%");
            }, function ($query) {
                $query->where($this->searchBy, 'like', "%{$this->search}%");
            })
            ->orderBy($this->orderBy, $this->orderDir)
            ->paginate($this->perPage);

        $this->columns = ['id', 'name', 'slug', 'posts_count'];

        $this->perPages = [5, 10, 20, 50];

        $topCategoryUsed = Category::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->first();
        $inTrashed = Category::onlyTrashed()->count();

        return view('admin.livewire.pages.category-table', compact('headers', 'rows', 'topCategoryUsed', 'inTrashed'))
            ->extends('admin.livewire.dashboard')
            ->section('content');
    }

    public function create()
    {
        $validated =   $this->validate([
            'image' => 'required|file|image|mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string|unique:categories,name',
            'slug' => 'required|string|unique:categories,slug',
            'description' => 'required|string|max:1000',
        ]);

        try {
            $validated['image'] = $validated['image']->store('categories', 'public');
            Category::create($validated);
            session()->flash('success', trans('The category has been created successfully'));
            $this->resetField();
            $this->closeModal('createModal');
        } catch (Exception $e) {
            Log::error('[createCategory]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to create category'));
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->existingImage = $category->image;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
    }

    public function updatedName()
    {
        $this->slug = str()->slug($this->name);
    }

    public function update($id)
    {
        $category = Category::findOrFail($id);
        $validated =   $this->validate([
            'image' => 'nullable|sometimes|file|image|mimes:jpg,jpeg,png|max:1024',
            'name' => 'required|string|unique:categories,name,' . $category->id,
            'slug' => 'required|string|unique:categories,name,' . $category->id,
            'description' => 'required|string|max:1000',
        ]);

        try {
            if (isset($validated['image'])) {
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }
                $validated['image'] = $validated['image']->store('categories', 'public');
            } else {
                $validated['image'] = $category->image;
            }

            $category->update($validated);
            session()->flash('success', trans('The category has been updated successfully'));
            $this->resetField();
            $this->closeModal('editModal');
        } catch (Exception $e) {
            Log::error('[updateCategory]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update category'));
        }
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        try {
            if ($category) {
                $category->delete();
                session()->flash('success', trans('The category has been deleted successfully'));
                $this->closeModal('deleteModal');
            } else {
                session()->flash('error', trans('Category not found'));
            }
        } catch (Exception $e) {
            Log::error('[deleteCategory]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to delete category'));
        }
    }

    public function resetField()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'searchBy', 'perPage', 'orderBy', 'orderDir']);
        $this->dispatch('urlReset', route('admin.table.categories'));
    }
}

<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Traits\ModalTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\{Component, WithPagination};

class CategoryTable extends Component
{
    use WithPagination, ModalTrait;

    public $categoryId;

    public function render()
    {
        $headers = ['Image', 'Id', 'Name', 'Slug', 'Actions'];
        $rows = Category::paginate(5);

        return view('admin.livewire.pages.category-table', compact('headers', 'rows'))
            ->extends('admin.livewire.dashboard')
            ->section('content');
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
}

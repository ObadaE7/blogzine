<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\{Component,WithPagination};
class PostTable extends Component
{
    use WithPagination;

    public function render()
    {
        $headers = ['Image', 'Titles', 'Status', 'Actions'];
        $rows = Post::paginate(5);

        return view('admin.livewire.pages.post-table', compact('headers', 'rows'))
            ->extends('admin.livewire.dashboard')
            ->section('content');
    }
}

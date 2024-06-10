<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Models\User;
use App\Traits\FilterTrait;
use App\Traits\ModalTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\{Component, WithPagination};

class UserTable extends Component
{
    use WithPagination, ModalTrait, FilterTrait;

    public $userId;
    public $postId;
    public $fname;
    public $lname;
    public $uname;
    public $email;
    public $phone;
    public $birthday;
    public $columns;
    public $perPages;

    public function render()
    {
        $headers = ['Avatar', 'Name', 'Email', 'Actions'];
        $rows = User::where($this->searchBy, 'like', "%{$this->search}%")
            ->orderBy($this->orderBy, $this->orderDir)
            ->paginate($this->perPage);
        $this->columns = ['fname', 'lname', 'uname', 'email'];
        $this->perPages = [5, 10, 20, 50];

        $inTrashed = User::onlyTrashed()->count();
        $Inactive = User::whereNull('email_verified_at')->count();

        $userPosts = $this->userPosts($this->userId);
        $postHeaders = $userPosts['headers'];
        $postRows = $userPosts['rows'];

        return view('admin.livewire.pages.user-table', compact('headers', 'rows', 'inTrashed', 'Inactive', 'postHeaders', 'postRows'))
            ->extends('admin.livewire.dashboard')
            ->section('content');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->fname = $user->fname;
        $this->lname = $user->lname;
        $this->uname = $user->uname;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->birthday = $user->birthday;
    }

    public function update($id)
    {
        $user = User::findOrFail($id);
        $validated =   $this->validate([
            'uname' => 'required|size:8|string|unique:users,uname,' . $user->id,
            'fname' => 'required|min:5|alpha',
            'lname' => 'required|min:5|alpha',
            'phone' => 'nullable|numeric|digits:10|unique:users,phone,' . $user->id,
            'email' => 'required|string|unique:users,email,' . $user->id,
            'birthday' => 'nullable|date',
        ]);

        try {
            $user->update($validated);
            session()->flash('success', trans('The user has been updated successfully'));
            $this->closeModal('editModal');
        } catch (Exception $e) {
            Log::error('[updateUser]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update user'));
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        try {
            if ($user) {
                $user->delete();
                session()->flash('success', trans('The user has been deleted successfully'));
                $this->closeModal('deleteModal');
            } else {
                session()->flash('error', trans('User not found'));
            }
        } catch (Exception $e) {
            Log::error('[deleteUser]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to delete user'));
        }
    }

    public function userPosts($id)
    {
        $headers = ['Image', 'Titles', 'Status', 'Actions'];
        $rows = Post::where('user_id', $id)->paginate(4, ['*'], 'user-post');
        return ['headers' => $headers, 'rows' => $rows];
    }

    public function deleteUserPost($id)
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

    public function resetField()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'searchBy', 'perPage', 'orderBy', 'orderDir']);
        $this->dispatch('urlReset', route('admin.table.users'));
    }
}

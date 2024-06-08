<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Traits\ModalTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\{Component, WithPagination};

class UserTable extends Component
{
    use WithPagination, ModalTrait;

    public $userId;

    public function render()
    {
        $headers = ['Avatar', 'Name', 'Email', 'Actions'];
        $rows = User::paginate(5);
        return view('admin.livewire.pages.user-table', compact('headers', 'rows'))
            ->extends('admin.livewire.dashboard')
            ->section('content');
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
}

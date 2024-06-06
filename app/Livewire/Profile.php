<?php

namespace App\Livewire;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Profile extends Component
{
    public $uname;
    public $fname;
    public $lname;
    public $bio;
    public $phone;
    public $birthday;
    public $email;

    public function render()
    {
        return view('livewire.pages.profile')
            ->extends('livewire.layouts.dashboard')
            ->section('content');
    }

    public function mount()
    {
        $user = auth()->user();
        $this->uname = $user->uname;
        $this->fname = $user->fname;
        $this->lname = $user->lname;
        $this->bio = $user->bio;
        $this->phone = $user->phone;
        $this->birthday = $user->birthday;
        $this->email = $user->email;
    }

    public function updatedFname()
    {
        $user_id = auth()->user()->id;
        $this->validateOnly('fname', ['fname' => 'required|string|min:5']);
        try {
            User::where('id', $user_id)->update(['fname' => $this->fname]);
            session()->flash('fname', 'updated!');
            $this->dispatch('resetSuccessMessage', field: 'fname');
        } catch (Exception $e) {
            Log::error('[updatedFname]: ' . $e->getMessage());
            session()->flash('error', 'Failed to update first name');
        }
    }

    public function updatedLname()
    {
        $user_id = auth()->user()->id;
        $this->validateOnly('lname', ['lname' => 'required|string|min:5']);
        try {
            User::where('id', $user_id)->update(['lname' => $this->lname]);
            session()->flash('lname', 'updated!');
            $this->dispatch('resetSuccessMessage', field: 'lname');
        } catch (Exception $e) {
            Log::error('[updatedLname]: ' . $e->getMessage());
            session()->flash('error', 'Failed to update last name');
        }
    }

    public function updatedUname()
    {
        $user_id = auth()->user()->id;
        $this->validateOnly('uname', ['uname' => 'required|string|size:8|unique:users,uname,' . $user_id]);
        try {
            User::where('id', $user_id)->update(['uname' => $this->uname]);
            session()->flash('uname', 'updated!');
            $this->dispatch('resetSuccessMessage', field: 'uname');
        } catch (Exception $e) {
            Log::error('[updatedUname]: ' . $e->getMessage());
            session()->flash('error', 'Failed to update username');
        }
    }

    public function updatedBio()
    {
        $user_id = auth()->user()->id;
        $this->validateOnly('bio', ['bio' => 'required|string|min:10']);
        try {
            User::where('id', $user_id)->update(['bio' => $this->bio]);
            session()->flash('bio', 'updated!');
            $this->dispatch('resetSuccessMessage', field: 'bio');
        } catch (Exception $e) {
            Log::error('[updatedBio]: ' . $e->getMessage());
            session()->flash('error', 'Failed to update bio');
        }
    }

    public function updatedPhone()
    {
        $user_id = auth()->user()->id;
        $this->validateOnly('phone', ['phone' => 'required|numeric|digits:10']);
        try {
            User::where('id', $user_id)->update(['phone' => $this->phone]);
            session()->flash('phone', 'updated!');
            $this->dispatch('resetSuccessMessage', field: 'phone');
        } catch (Exception $e) {
            Log::error('[updatedPhone]: ' . $e->getMessage());
            session()->flash('error', 'Failed to update phone');
        }
    }

    public function updatedBirthday()
    {
        $user_id = auth()->user()->id;
        $this->validateOnly('birthday', ['birthday' => 'required|date']);
        try {
            User::where('id', $user_id)->update(['birthday' => $this->birthday]);
            session()->flash('birthday', 'updated!');
            $this->dispatch('resetSuccessMessage', field: 'birthday');
        } catch (Exception $e) {
            Log::error('[updatedBirthday]: ' . $e->getMessage());
            session()->flash('error', 'Failed to update birthday');
        }
    }

    public function saveEmail()
    {
        $user_id = auth()->user()->id;
        User::where('id', $user_id)->update(['email' => $this->email]);
    }

    public function resetSuccessMessage($field)
    {
        $this->resetErrorBag($field);
    }
}

<?php

namespace App\Livewire;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $uname;
    public $fname;
    public $lname;
    public $bio;
    public $phone;
    public $birthday;
    public $email;
    public $eu_current_password;
    public $password;
    public $current_password;
    public $password_confirmation;
    public $cover;
    public $avatar;

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
        $this->validateOnly('bio', ['bio' => 'required|string|min:10|max:1000']);
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
        $validated = $this->validate([
            'email' => 'required|string|email|unique:users,email,' . $user_id . '|max:255',
            'eu_current_password' => 'required|string|current_password'
        ], ['eu_current_password.required' => 'The current password field is required.']);

        try {
            if ($validated) {
                User::where('id', $user_id)->update(['email' => $this->email]);
                session()->flash('email', 'updated!');
                $this->dispatch('resetSuccessMessage', field: 'email');
                $this->reset(['eu_current_password']);
            }
        } catch (Exception $e) {
            Log::error('[saveEmail]: ' . $e->getMessage());
            session()->flash('error', 'Failed to update email');
        }
    }

    public function savePassword()
    {
        $user = auth()->user();
        $validated = $this->validate([
            'current_password' => 'required|string|current_password',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'password_confirmation' => 'required',
        ], [
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, and one digit.',
        ]);

        try {
            if (Hash::check($this->current_password, $user->password)) {
                User::where('id', $user->id)->update(['password' => Hash::make($validated['password'])]);
            }
            session()->flash('password', 'updated!');
            $this->dispatch('resetSuccessMessage', field: 'password');
            $this->reset(['current_password', 'password', 'password_confirmation']);
        } catch (Exception $e) {
            Log::error('[savePassword]: ' . $e->getMessage());
            session()->flash('error', 'Failed to update password');
        }
    }

    public function updatedCover()
    {
        $user = auth()->user();
        $validated =  $this->validateOnly('cover', ['cover' => 'required|file|image|mimes:jpg,jpeg,png|max:1024']);
        try {
            if ($validated) {
                $path = $validated['cover']->store('covers', 'public');
                if ($user->cover) {
                    Storage::disk('public')->delete($user->cover);
                }
                User::where('id', $user->id)->update(['cover' => $path]);
                session()->flash('cover', 'updated!');
                $this->dispatch('resetSuccessMessage', field: 'cover');
            }
        } catch (Exception $e) {
            Log::error('[updatedCover] ' . $e->getMessage());
            session()->flash('error', trans('Failed to update cover'));
        }
    }

    public function updatedAvatar()
    {
        $user = auth()->user();
        $validated =  $this->validateOnly('avatar', ['avatar' => 'required|file|image|mimes:jpg,jpeg,png|max:1024']);
        try {
            if ($validated) {
                $path = $validated['avatar']->store('avatars', 'public');
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }
                User::where('id', $user->id)->update(['avatar' => $path]);
                session()->flash('avatar', 'updated!');
                $this->dispatch('resetSuccessMessage', field: 'avatar');
            }
        } catch (Exception $e) {
            Log::error('[updatedAvatar] ' . $e->getMessage());
            session()->flash('error', trans('Failed to update avatar'));
        }
    }

    public function resetSuccessMessage($field)
    {
        $this->resetErrorBag($field);
    }
}

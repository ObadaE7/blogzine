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

    public $cover;
    public $avatar;
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
        $id = auth()->user()->id;
        $this->validateOnly(
            'fname',
            ['fname' => 'required|min:5|alpha'],
            [
                'fname.required' => 'The first name field is required.',
                'fname.alpha' => 'The first name field must only contain letters.',
                'fname.min' => 'The first name field must be at least 5 characters.',
            ]
        );
        try {
            User::findOrFail($id)->update(['fname' => $this->fname]);
            session()->flash('fname', trans('updated!'));
            $this->dispatch('resetSuccessMessage', field: 'fname');
        } catch (Exception $e) {
            Log::error('[updatedFname]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update first name'));
        }
    }

    public function updatedLname()
    {
        $id = auth()->user()->id;
        $this->validateOnly(
            'lname',
            ['lname' => 'required|min:5|alpha'],
            [
                'lname.required' => 'The last name field is required.',
                'lname.alpha' => 'The last name field must only contain letters.',
                'lname.min' => 'The last name field must be at least 5 characters.',
            ]
        );
        try {
            User::findOrFail($id)->update(['lname' => $this->lname]);
            session()->flash('lname', trans('updated!'));
            $this->dispatch('resetSuccessMessage', field: 'lname');
        } catch (Exception $e) {
            Log::error('[updatedLname]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update last name'));
        }
    }

    public function updatedUname()
    {
        $id = auth()->user()->id;
        $this->validateOnly(
            'uname',
            ['uname' => 'required|size:8|string|unique:users,uname,' . $id],
            [
                'uname.required' => 'The username field is required.',
                'uname.size' => 'The username field must be 8 characters.',
                'uname.string' => 'The username field must be a string.',
                'uname.unique' => 'The username has already been taken.',
            ]
        );
        try {
            User::findOrFail($id)->update(['uname' => $this->uname]);
            session()->flash('uname', trans('updated!'));
            $this->dispatch('resetSuccessMessage', field: 'uname');
        } catch (Exception $e) {
            Log::error('[updatedUname]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update username'));
        }
    }

    public function updatedBio()
    {
        $id = auth()->user()->id;
        $this->validateOnly('bio', ['bio' => 'nullable|min:10|string|max:500']);
        try {
            User::findOrFail($id)->update(['bio' => $this->bio]);
            session()->flash('bio', trans('updated!'));
            $this->dispatch('resetSuccessMessage', field: 'bio');
        } catch (Exception $e) {
            Log::error('[updatedBio]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update bio'));
        }
    }

    public function updatedPhone()
    {
        $id = auth()->user()->id;
        $this->validateOnly('phone', ['phone' => 'nullable|numeric|digits:10']);
        try {
            User::findOrFail($id)->update(['phone' => $this->phone]);
            session()->flash('phone', trans('updated!'));
            $this->dispatch('resetSuccessMessage', field: 'phone');
        } catch (Exception $e) {
            Log::error('[updatedPhone]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update phone'));
        }
    }

    public function updatedBirthday()
    {
        $id = auth()->user()->id;
        $this->validateOnly('birthday', ['birthday' => 'nullable|date']);
        try {
            User::findOrFail($id)->update(['birthday' => $this->birthday]);
            session()->flash('birthday', trans('updated!'));
            $this->dispatch('resetSuccessMessage', field: 'birthday');
        } catch (Exception $e) {
            Log::error('[updatedBirthday]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update birthday'));
        }
    }

    public function saveEmail()
    {
        $id = auth()->user()->id;
        $validated = $this->validate(
            [
                'email' => 'required|string|email|unique:users,email,' . $id . '|max:255',
                'eu_current_password' => 'required|string|current_password'
            ],
            ['eu_current_password.required' => 'The current password field is required.']
        );

        try {
            if ($validated) {
                User::findOrFail($id)->update(['email' => $this->email]);
                session()->flash('email', trans('updated!'));
                $this->dispatch('resetSuccessMessage', field: 'email');
                $this->reset(['eu_current_password']);
            }
        } catch (Exception $e) {
            Log::error('[saveEmail]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update email'));
        }
    }

    public function savePassword()
    {
        $user = auth()->user();
        $validated = $this->validate(
            [
                'current_password' => 'required|string|current_password',
                'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'password_confirmation' => 'required',
            ],
            [
                'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, and one digit.',
            ]
        );

        try {
            if (Hash::check($this->current_password, $user->password)) {
                User::where('id', $user->id)->update(['password' => Hash::make($validated['password'])]);
            }
            session()->flash('password', trans('updated!'));
            $this->dispatch('resetSuccessMessage', field: 'password');
            $this->reset(['current_password', 'password', 'password_confirmation']);
        } catch (Exception $e) {
            Log::error('[savePassword]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update password'));
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
                session()->flash('cover', trans('updated!'));
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
                session()->flash('avatar', trans('updated!'));
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

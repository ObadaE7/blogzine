<?php

namespace App\Livewire\Admin\Tables;

use App\Models\User;
use Livewire\Component;
use Exception;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\{Hash, Log, Storage};

class ShowUser extends Component
{
    use WithFileUploads;

    public $userId;
    public $cover;
    public $existingCover;
    public $avatar;
    public $existingAvatar;
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
        return view('admin.livewire.pages.tables.show-user')
            ->extends('admin.livewire.dashboard')
            ->section('content');
    }

    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->uname = $user->uname;
        $this->fname = $user->fname;
        $this->lname = $user->lname;
        $this->bio = $user->bio;
        $this->phone = $user->phone;
        $this->birthday = $user->birthday;
        $this->email = $user->email;
        $this->existingAvatar = $user->avatar;
        $this->existingCover = $user->cover;
    }

    public function updatedFname()
    {
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
            if (auth()->guard('admin')->check()) {
                User::findOrFail($this->userId)->update(['fname' => $this->fname]);
                session()->flash('fname', trans('updated!'));
                $this->dispatch('resetSuccessMessage', field: 'fname');
            } else {
                session()->flash('error', trans('You don\'t have access!'));
            }
        } catch (Exception $e) {
            Log::error('[updatedFname]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update first name'));
        }
    }

    public function updatedLname()
    {
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
            if (auth()->guard('admin')->check()) {
                User::findOrFail($this->userId)->update(['lname' => $this->lname]);
                session()->flash('lname', trans('updated!'));
                $this->dispatch('resetSuccessMessage', field: 'lname');
            } else {
                session()->flash('error', trans('You don\'t have access!'));
            }
        } catch (Exception $e) {
            Log::error('[updatedLname]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update last name'));
        }
    }

    public function updatedUname()
    {
        $this->validateOnly(
            'uname',
            ['uname' => 'required|size:8|string|unique:users,uname,' . $this->userId],
            [
                'uname.required' => 'The username field is required.',
                'uname.size' => 'The username field must be 8 characters.',
                'uname.string' => 'The username field must be a string.',
                'uname.unique' => 'The username has already been taken.',
            ]
        );
        try {
            if (auth()->guard('admin')->check()) {
                User::findOrFail($this->userId)->update(['uname' => $this->uname]);
                session()->flash('uname', trans('updated!'));
                $this->dispatch('resetSuccessMessage', field: 'uname');
            } else {
                session()->flash('error', trans('You don\'t have access!'));
            }
        } catch (Exception $e) {
            Log::error('[updatedUname]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update username'));
        }
    }

    public function updatedBio()
    {
        $this->validateOnly('bio', ['bio' => 'nullable|min:10|string|max:500']);
        try {
            if (auth()->guard('admin')->check()) {
                User::findOrFail($this->userId)->update(['bio' => $this->bio]);
                session()->flash('bio', trans('updated!'));
                $this->dispatch('resetSuccessMessage', field: 'bio');
            } else {
                session()->flash('error', trans('You don\'t have access!'));
            }
        } catch (Exception $e) {
            Log::error('[updatedBio]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update bio'));
        }
    }

    public function updatedPhone()
    {
        $this->validateOnly('phone', ['phone' => 'nullable|numeric|digits:10']);
        try {
            if (auth()->guard('admin')->check()) {
                User::findOrFail($this->userId)->update(['phone' => $this->phone]);
                session()->flash('phone', trans('updated!'));
                $this->dispatch('resetSuccessMessage', field: 'phone');
            } else {
                session()->flash('error', trans('You don\'t have access!'));
            }
        } catch (Exception $e) {
            Log::error('[updatedPhone]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update phone'));
        }
    }

    public function updatedBirthday()
    {
        $this->validateOnly('birthday', ['birthday' => 'nullable|date']);
        try {
            if (auth()->guard('admin')->check()) {
                User::findOrFail($this->userId)->update(['birthday' => $this->birthday]);
                session()->flash('birthday', trans('updated!'));
                $this->dispatch('resetSuccessMessage', field: 'birthday');
            } else {
                session()->flash('error', trans('You don\'t have access!'));
            }
        } catch (Exception $e) {
            Log::error('[updatedBirthday]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update birthday'));
        }
    }

    public function saveEmail()
    {
        $this->validate(['email' => 'required|string|email|unique:users,email,' .  $this->userId . '|max:255',],);
        try {
            if (auth()->guard('admin')->check()) {
                User::findOrFail($this->userId)->update(['email' => $this->email]);
                session()->flash('email', trans('updated!'));
                $this->dispatch('resetSuccessMessage', field: 'email');
            } else {
                session()->flash('error', trans('You don\'t have access!'));
            }
        } catch (Exception $e) {
            Log::error('[saveEmail]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update email'));
        }
    }

    public function savePassword()
    {
        $validated = $this->validate(
            [
                'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'password_confirmation' => 'required',
            ],
            [
                'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, and one digit.',
            ]
        );

        try {
            if (auth()->guard('admin')->check()) {
                User::findOrFail($this->userId)->update(['password' => Hash::make($validated['password'])]);
                session()->flash('password', trans('updated!'));
                $this->dispatch('resetSuccessMessage', field: 'password');
                $this->reset(['password', 'password_confirmation']);
            } else {
                session()->flash('error', trans('You don\'t have access!'));
            }
        } catch (Exception $e) {
            Log::error('[savePassword]: ' . $e->getMessage());
            session()->flash('error', trans('Failed to update password'));
        }
    }

    public function updatedCover()
    {
        $validated =  $this->validateOnly('cover', ['cover' => 'required|file|image|mimes:jpg,jpeg,png|max:1024']);
        try {
            $user =  User::findOrFail($this->userId);
            if ($validated && auth()->guard('admin')->check()) {
                $path = $validated['cover']->store('covers/users', 'public');
                if ($user->cover) {
                    Storage::disk('public')->delete($user->cover);
                }
                $user->update(['cover' => $path]);
                session()->flash('cover', trans('updated!'));
                $this->dispatch('resetSuccessMessage', field: 'cover');
            } else {
                session()->flash('error', trans('You don\'t have access!'));
            }
        } catch (Exception $e) {
            Log::error('[updatedCover] ' . $e->getMessage());
            session()->flash('error', trans('Failed to update cover'));
        }
    }

    public function updatedAvatar()
    {
        $validated =  $this->validateOnly('avatar', ['avatar' => 'required|file|image|mimes:jpg,jpeg,png|max:1024']);
        try {
            $user =  User::findOrFail($this->userId);
            if ($validated && auth()->guard('admin')->check()) {
                $path = $validated['avatar']->store('avatars/users', 'public');
                if ($user->avatar) {
                    Storage::disk('public')->delete($user->avatar);
                }
                $user->update(['avatar' => $path]);
                session()->flash('avatar', trans('updated!'));
                $this->dispatch('resetSuccessMessage', field: 'avatar');
            } else {
                session()->flash('error', trans('You don\'t have access!'));
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

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        $github = Socialite::driver('github')->user();
        $fullName = $github->getName();
        $nameParts = explode(' ', $fullName);

        $fname = $nameParts[0];
        $lname = isset($nameParts[1]) ? $nameParts[1] : '';

        $user = User::updateOrCreate(
            [
                'github_id' => $github->getId(),
            ],
            [
                'uname' => $github->getNickname(),
                'fname' =>  $fname,
                'lname' =>  $lname,
                'email' =>  $github->getEmail(),
            ]
        );

        Auth::login($user, true);
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}

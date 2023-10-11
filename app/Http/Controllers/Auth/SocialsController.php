<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialsController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        try {
            $socialsUser = Socialite::driver('github')->user();
        } catch (\Exception) {
            return redirect(route('login'));
        }

        $user = User::query()->where('email', $socialsUser->email)->first();

        if (!$user) {
            $user = new User([
                'name' => $socialsUser->name,
                'email' => $socialsUser->email,
                'password' => Hash::make($socialsUser->name . $socialsUser->email . Date::now())
            ]);

            $user->save();
        }

        Auth::login($user, true);

        return redirect(route('home'));
    }
}

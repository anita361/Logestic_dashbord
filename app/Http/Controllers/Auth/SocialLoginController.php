<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialLoginController extends Controller
{
   public function redirectToGoogle()
{
    return Socialite::driver('google')->stateless()->redirect();
}

public function handleGoogleCallback()
{
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::updateOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
        ]
    );

    Auth::login($user);

    return redirect()->intended('/dashboard');
}

   public function redirectToApple()
{
    return Socialite::driver('apple')->stateless()->redirect();
}

public function handleAppleCallback()
{
    $appleUser = Socialite::driver('apple')->stateless()->user();

    $user = User::updateOrCreate(
        ['email' => $appleUser->getEmail()],
        [
            'name' => $appleUser->getName(),
            'apple_id' => $appleUser->getId(),
            'avatar' => $appleUser->getAvatar(),
        ]
    );

    Auth::login($user);

    return redirect()->intended('/dashboard');
}

public function logout()
{
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();

    $redirectUrl = urlencode(route('login')); // or home page
    $googleLogoutUrl = "https://accounts.google.com/Logout?continue=https://appengine.google.com/_ah/logout?continue={$redirectUrl}";

    return redirect($googleLogoutUrl);
}
}

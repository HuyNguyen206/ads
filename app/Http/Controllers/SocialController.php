<?php

namespace App\Http\Controllers;

use App\Models\SocialProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $providerUser = Socialite::driver($provider)->user();
        $user = User::query()->updateOrCreate(['email' => $providerUser->email], [
            'name' => $providerUser->getName() ?? $providerUser->getNickname(),
            'email' => $providerUser->getEmail()
            ]);
        if ($url = $providerUser->avatar) {
            $user->addMediaFromUrl($url)->toMediaCollection("avatar.$provider");
        }
        SocialProvider::updateOrCreate([
            'provider_id' => $providerUser->getId(),
            'provider' => $provider,
            'user_id' => $user->id
        ],
        [
            'token' => $providerUser->token,
            'refresh_token' => $providerUser->refreshToken,
        ]);

        Auth::login($user);
        return redirect()->route('home');
    }
}

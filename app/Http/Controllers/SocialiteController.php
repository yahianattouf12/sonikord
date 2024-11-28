<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            dd($user);
            $find_user = User::where('social_id', $user->id)->first();
            if($find_user) {
                Auth::login($find_user);
                return response()->json($find_user);
            }
            else {
                $new_user = User::create([
                    'name' => $user->name,
                    'email' =>$user->email,
                    'social_id' => $user->id,
                    'social_type' => 'google',
                    'password' => Hash::make('my-google'),
                ]);
                return response()->json($new_user);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    } 
}

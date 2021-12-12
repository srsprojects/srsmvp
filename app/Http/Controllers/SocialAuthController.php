<?php

namespace App\Http\Controllers;

use App\Models\User;
use Socialite;
use Exception;
use Auth;

class SocialAuthController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();
            $existingEmail = User::where('email', $user->email)->first();

            if ($isUser) {
                Auth::login($isUser);
                return redirect('/dashboard');
            } 
            elseif ($existingEmail) {
                $existingEmail->fb_id = $user->id;
                $existingEmail->save();
                Auth::login($existingEmail);
                return redirect('/dashboard');
            }
            else {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('pass@123')
                ]);

                Auth::login($createUser);
                return redirect('/dashboard');
            }
        } catch (Exception $exception) {
            return back()->with('danger',$exception->getMessage());
        }
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $isUser = User::where('google_id', $user->id)->first();
            $existingEmail = User::where('email', $user->email)->first();

            if ($isUser) {
                Auth::login($isUser);
                return redirect('/dashboard');
            } 
            elseif ($existingEmail) {
                $existingEmail->google_id = $user->id;
                $existingEmail->save();
                Auth::login($existingEmail);
                return redirect('/dashboard');
            }
            else {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('pass@123')
                ]);

                Auth::login($createUser);
                return redirect('/dashboard');
            }
        } catch (Exception $exception) {
            return back()->with('danger',$exception->getMessage());
        }
    }
}

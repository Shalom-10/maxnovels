<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleOauthController extends Controller
{
    //

    public function create() {
        try {
            $user = Socialite::driver('google')->user();
    
            session(['oauth_data' => $user->user]);

            $user = User::where('email', $user->user['email'])->first();

            $user = $user == null ? null : $user->toArray();
    
            if($user != null && Auth::loginUsingId($user)) {
                session(['signin' => true,'user' => $user]);
                return redirect('/');
            }
            
            return redirect('/oauth/get_details');
        }
        catch(Exception $exception) {
            return redirect('/signup');
        }
    }

    public function store() {
        $attributes = request()->validate([
            'gender' => ['required', Rule::in(['male', 'female'])],
            'day' => ['required', 'numeric'],
            'month' => ['required', 'numeric'],
            'year' => ['required', 'numeric'],
        ]);

        $attributes['date_of_birth'] = $attributes['year'] . '-' . $attributes['month'] . '-' . $attributes['day'];

        unset($attributes['year']);
        unset($attributes['month']);
        unset($attributes['day']);

        $oauth_data = session('oauth_data');

        $user = User::create([
            'first_name' => $oauth_data['given_name'],
            'last_name' => $oauth_data['family_name'],
            'email' => $oauth_data['email'],
            'gender' => $attributes['gender'],
            'date_of_birth' => $attributes['date_of_birth'],
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igisdfa',
            'remember_token' => Str::random(10),
        ]);

        

        if(Auth::loginUsingId($user->toArray()['id'])) {

            session()->forget('oauth_data');
            session(['signup' => true, 'signin' => true, 'user' => $user->toArray()]);
            return redirect('/books');
        }

        else return redirect('/signup');
        
    }
}

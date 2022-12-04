<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\OauthUser;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    //

    public function create() {
        return view('login');
    }

    public function store() {
        

        $attributes = request()->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'day' => ['required', 'numeric'],
            'month' => ['required', 'numeric'],
            'year' => ['required', 'numeric'],
            'password' => 'required|required_with:re_password|same:re_password',
            're_password' => 'required',

        ]);

        $attributes['date_of_birth'] = $attributes['year'] . '-' . $attributes['month'] . '-' . $attributes['day'];

        unset($attributes['year']);
        unset($attributes['month']);
        unset($attributes['day']);
        unset($attributes['re_password']);

        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['remember_token'] = Str::random(10);


        if($user = User::create($attributes))
        event(new Registered($user));

        if(Auth::loginUsingId($user->id)) {
            session(['signup' => true, 'signin' => true, 'user' => $user->toArray()]);
            return redirect('/books');
        }

    }

    public function facebook() {
        $user = Socialite::driver('facebook')->user();

        dd($user);

        // session(['oauth_data' => $user->user]);

        // if(OauthUser::where('email', $user->user['email'])->first() != null) {
        //     session(['signin' => true]);
        //     return redirect('/');
        // }
     
        // return redirect('/oauth/get_details');
    }

    public function oauth() {


    }

}
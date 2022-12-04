<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    //

    public function login() {

        $attributes = request()->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        // $attributes['password'] = bcrypt($attributes['password']);

        if(Auth::attempt($attributes)){

            session(['signin' => true,'user' => User::where('email', $attributes['email'])->first()->toArray()]);
            return redirect('/');
        };

        return redirect('/login');

    }
}

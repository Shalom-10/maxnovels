<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //

    public function logout() {
        Auth::guard('web')->logout();
        Auth::guard('oauth')->logout();
        session()->flush();
        return redirect('/');
    }
}

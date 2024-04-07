<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback()
    {
        $user = Socialite::driver('facebook')->user();
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        $user = auth()->user();

        if (
            $user->role->name === 'admin'
        ) {

            return route(
                'chat.support.index'
            );

        }

        return route('home');
    }

    public function __construct()
    {
        $this->middleware('guest')
            ->except('logout');

        $this->middleware('auth')
            ->only('logout');
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class EmailLoginController extends Controller
{
    public function __invoke(User $user)
    {
        auth()->login($user);

        return redirect()->route('home');
    }
}

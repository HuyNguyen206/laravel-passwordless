<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class EmailRegisterController extends Controller
{
        public function __invoke($name, $email)
    {
        auth()->login(User::factory()->create([
            'name' => $name,
            'email' => $email
        ]));

        return redirect()->route('home');
    }
}

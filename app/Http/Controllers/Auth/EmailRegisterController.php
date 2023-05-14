<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class EmailRegisterController extends Controller
{
    public function __invoke($name, $email)
    {
        if (User::query()->where('email', trim($email))->exists()) {
            abort(Response::HTTP_BAD_REQUEST, 'This user already register!');
        }

        auth()->login(User::factory()->create([
            'name' => $name,
            'email' => $email
        ]));

        return redirect()->route('home');
    }
}

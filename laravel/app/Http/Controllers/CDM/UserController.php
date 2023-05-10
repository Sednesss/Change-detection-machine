<?php

namespace App\Http\Controllers\CDM;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $name = $request['name'];
        $email = $request['email'];
        $password = $request['password'];

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function authenticate(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];

        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            $user = Auth::user();
            Auth::login($user);

            return redirect()->route('home');
        } else {
            return back()->withErrors([
                'email' => 'Неверный email или пароль',
            ]);
        }
    }
}

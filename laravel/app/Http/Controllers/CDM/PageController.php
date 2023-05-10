<?php

namespace App\Http\Controllers\CDM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        $menu = [
            'Главная',
            'Личный кабинет',
            'Мои проекты',
            'О нас',
            'Связаться с нами'
        ];

        if (!Auth::check()) {
            unset($menu[1]);
            unset($menu[2]);
        }
        return view('home', ['menu' => $menu]);
    }

    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function rules()
    {
        return view('rules');
    }
}

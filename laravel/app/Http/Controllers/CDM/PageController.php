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
            'Главная' => 'home',
            'Личный кабинет' => 'profile',
            'Мои проекты' => 'projects',
            'О нас' => 'about',
            'Связаться с нами' => 'connect'
        ];

        $auth_button = ['Выйти' => 'users.logout'];
        $home_button = ['Создать новый проект' => 'projects.create'];

        if (!Auth::check()) {
            array_splice($menu, 1, 2);
            $auth_button = ['Войти' => 'login'];
            $home_button = ['Начать работу' => 'register'];
        }

        $content = [
            'menu' => $menu,
            'auth_button' => $auth_button,
            'home_button' => $home_button
        ];

        return view('home', $content);
    }

    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function about()
    {
        return view('about');
    }

    public function connect()
    {
        return view('connect');
    }

    public function rules()
    {
        return view('rules');
    }

    public function profile()
    {
        return view('profile');
    }

    public function projects()
    {
        return view('projects');
    }

    public function projectCreate()
    {
        return view('project-create');
    }

    public function project()
    {
        return view('project');
    }
}

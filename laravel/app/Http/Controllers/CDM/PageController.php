<?php

namespace App\Http\Controllers\CDM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){
        return view('home');
    }

    public function register(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function rules(){
        return view('rules');
    }
}

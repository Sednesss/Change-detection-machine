<?php

namespace App\Http\Controllers\CDM;

use App\Helpers\App\MenuHelper;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        $is_auth_user = Auth::check();
        $menu = (new MenuHelper())->getMenu($is_auth_user);

        $home_button = ['Создать новый проект' => 'projects.create'];

        if (!$is_auth_user) {
            $home_button = ['Начать работу' => 'register'];
        }

        $content = $menu;
        $content['home_button'] = $home_button;

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
        $is_auth_user = Auth::check();
        if (!$is_auth_user) {
            return redirect()->route('home');
        }
        
        return view('profile');
    }

    public function projects()
    {
        $is_auth_user = Auth::check();
        if (!$is_auth_user) {
            return redirect()->route('home');
        }

        return view('projects');
    }

    public function projectCreate()
    {
        $is_auth_user = Auth::check();
        if (!$is_auth_user) {
            return redirect()->route('home');
        }

        $menu = (new MenuHelper())->getMenu($is_auth_user);
        $content = $menu;

        return view('project-create', $content);
    }

    public function project($slug)
    {
        $is_auth_user = Auth::check();
        if (!$is_auth_user) {
            return redirect()->route('home');
        }

        $menu = (new MenuHelper())->getMenu($is_auth_user);
        $content = $menu;

        $project = Project::where('slug', $slug)->first();
        $content['project'] = $project;

        return view('project', $content);
    }
}

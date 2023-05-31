<?php

namespace App\Http\Controllers\CDM;

use App\Helpers\App\MenuHelper;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\SatelliteImage;
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

        $menu = (new MenuHelper())->getMenu($is_auth_user);
        $content = $menu;

        $projects = Auth::user()->projects;
        $content['projects'] = $projects;
        $content['table_header_buttons'] = ['Добавить проект' => 'projects.create'];

        return view('projects', $content);
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

        $content['global_value_project_map_center_x'] = $project->map_center_x;
        $content['global_value_project_map_center_y'] = $project->map_center_y;
        $content['global_value_project_data_max'] = $project->data_max;
        $content['global_value_project_data_min'] = $project->data_min;
        $content['global_value_project_data_start'] = $project->data_start;
        $content['global_value_project_data_end'] = $project->data_end;
        $content['global_value_project_status'] = $project->status;

        $content['table_images_buttons'] = ['Добавить снимок' => 'projects.images.create'];
        $content['table_images_buttons_element_delete'] = ['Удалить' => 'api.projects.satellite_images.delete'];

        $content['map'] = null;
        $content['colors'] = null;
        if (count($project->satelliteImage) != 0) {
            foreach ($project->satelliteImage as $satellite_image) {
                foreach ($satellite_image->boundaryPoint as $boundary_point) {
                    $content['map'][$satellite_image->id][$boundary_point->position] = [
                        'x' => $boundary_point->x,
                        'y' => $boundary_point->y
                    ];
                }
                $content['colors'][$satellite_image->id] = $satellite_image->colour;
            }
            $content['map'] = json_encode($content['map']);
            $content['colors'] = json_encode($content['colors']);
        }


        return view('project', $content);
    }

    public function satelliteImageCreate($slug)
    {
        $is_auth_user = Auth::check();
        if (!$is_auth_user) {
            return redirect()->route('home');
        }

        $menu = (new MenuHelper())->getMenu($is_auth_user);
        $content = $menu;

        $project = Project::where('slug', $slug)->first();

        $content['project'] = $project;

        return view('satellite-images-create', $content);
    }

    public function satelliteImage($project_slug, $slug)
    {
        $is_auth_user = Auth::check();
        if (!$is_auth_user) {
            return redirect()->route('home');
        }

        $menu = (new MenuHelper())->getMenu($is_auth_user);
        $content = $menu;

        $project = Project::where('slug', $project_slug)->first();
        $satellite_image = SatelliteImage::where('slug', $slug)->where('project_id', $project->id)->first();

        $content['satellite_image'] = $satellite_image;

        $content['global_value_satellite_image_map_center_x'] = $satellite_image->map_center_x;
        $content['global_value_satellite_image_map_center_y'] = $satellite_image->map_center_y;
        $content['global_value_satellite_image_status'] = $satellite_image->status;


        return view('satellite-image', $content);
    }
}

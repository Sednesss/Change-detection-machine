<?php

namespace App\Http\Controllers\CDM;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function list()
    {
        Project::all();

        // return redirect()->route('home');
    }

    // public function get($slug)
    // {
    //     Project::where('slug', $slug)->first();

    //     // return redirect()->route('home');
    // }

    public function create(Request $request)
    {
        $slug = Str::slug($request['name']);

        $project = Project::create([
            'user_id' => Auth::user()->id,
            'name' => $request['name'],
            'slug' => $slug,
            'type' => $request['type']
        ]);

        return redirect()->route('project', ['slug' => $slug]);
    }

    public function update(Request $request)
    {
        $slug = Str::slug($request['name']);
        $project = Project::where('slug', $slug)->first();

        $project->name = $request['name'];
        $project->slug = $slug;
        $project->type = $request['type'];

        $project->save();

        // return redirect()->route('home');
    }

    public function delete(Request $request)
    {
        $slug = Str::slug($request['name']);
        $project = Project::where('slug', $slug)->first();
        $project->delete();

        // return redirect()->route('home');
    }
}

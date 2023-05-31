<?php

namespace App\Http\Controllers\CDM;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function create(Request $request)
    {
        $slug = Str::slug($request['name']);

        $project = Project::create([
            'user_id' => Auth::user()->id,
            'name' => $request['name'],
            'slug' => $slug,
            'type' => $request['type'],
            'map_center_x' => 2347385,
            'map_center_y' => 8144115
        ]);

        return redirect()->route('project', ['slug' => $slug]);
    }

    public function update(Request $request)
    {
        $project = Project::where('slug', $request['slug'])->first();
        $slug = Str::slug($request['name']);

        $project->name = $request['name'];
        $project->slug = $slug;
        $project->type = $request['type'];

        $project->save();

        return redirect()->route('project', ['slug' => $slug]);
    }

    public function delete(Request $request)
    {
        $project = Project::where('slug', $request['slug'])->first();
        $project->delete();

        return redirect()->route('projects');
    }
}

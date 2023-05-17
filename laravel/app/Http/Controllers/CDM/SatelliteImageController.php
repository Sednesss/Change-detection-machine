<?php

namespace App\Http\Controllers\CDM;

use App\Http\Controllers\Controller;
use App\Models\SatelliteImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SatelliteImageController extends Controller
{
    public function create(Request $request)
    {
        $slug = Str::slug($request['name']);
        $colour = sprintf('#%06X', mt_rand(0, 0xFFFFFF));

        $satellite_image = SatelliteImage::create([
            'project_id' => $request['project_id'],
            'name' => $request['name'],
            'slug' => $slug,
            'type' => $request['type'],
            'colour' => $colour,
            'map_center_x' => 86.12,
            'map_center_y' => 70.20
        ]);
        $project_slug = $satellite_image->project->slug;
        
        $content = [
            'slug' => $slug,
            'project_slug' => $project_slug
        ];

        return redirect()->route('projects.image', $content);
    }

    public function delete(Request $request)
    {
        $satellite_image = SatelliteImage::where('slug', $request['slug'])->first();
        $satellite_image->delete();

        $project_slug = $satellite_image->project->slug;

        $content = [
            'slug' => $project_slug
        ];

        return redirect()->route('project', $content);
    }

    public function update(Request $request)
    {
        $satellite_image = SatelliteImage::where('slug', $request['slug'])->first();
        $satellite_image->delete();

        $project_slug = $satellite_image->project->slug;

        $content = [
            'slug' => $project_slug
        ];

        return redirect()->route('project', $content);
    }
}

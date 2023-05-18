<?php

namespace App\Http\Controllers\CDM;

use App\Http\Controllers\Controller;
use App\Models\SatelliteImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StorageController extends Controller
{
    public function satelliteImageSingleUpluad(Request $request)
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
}

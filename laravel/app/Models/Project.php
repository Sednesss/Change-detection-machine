<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = "projects";

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'type',
        'status',
        'map_center_x',
        'map_center_y',
        'data_max',
        'data_min',
        'data_start',
        'data_end',
        'intersection_area',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function satelliteImage()
    {
        return $this->hasMany(SatelliteImage::class);
    }

    public function resultProcessing()
    {
        return $this->hasMany(ResultProcessing::class);
    }

    protected static function booted()
    {
        static::deleting(function (Project $project) {
            $project->satelliteImage()->delete();
            $project->resultProcessing()->delete();
        });
    }
}

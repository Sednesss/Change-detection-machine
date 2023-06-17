<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatelliteImage extends Model
{
    use HasFactory;

    protected $table = "satellite_images";

    protected $fillable = [
        'project_id',
        'name',
        'slug',
        'type',
        'status',
        'colour',
        'map_center_x',
        'map_center_y',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function boundaryPoint()
    {
        return $this->hasMany(BoundaryPoint::class);
    }

    public function channelEmission()
    {
        return $this->hasMany(ChannelEmission::class);
    }

    protected static function booted()
    {
        static::deleting(function (SatelliteImage $satellite_image) {
            $satellite_image->channelEmission()->delete();
            $satellite_image->boundaryPoint()->delete();
        });
    }
}

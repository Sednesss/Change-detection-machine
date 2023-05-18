<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoundaryPoint extends Model
{
    use HasFactory;

    protected $table = "boundary_points";

    protected $fillable = [
        'satellite_image_id',
        'position',
        'x',
        'y'
    ];

    public function satelliteImage()
    {
        return $this->belongsTo(SatelliteImage::class);
    }
}

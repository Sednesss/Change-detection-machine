<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatelliteImageData extends Model
{
    use HasFactory;

    protected $table = "satellite_image_data";

    protected $fillable = [
        'satellite_image_id',
        'data'
    ];

    public function satelliteImage()
    {
        return $this->belongsTo(SatelliteImage::class);
    }
}

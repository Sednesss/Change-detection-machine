<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelEmission extends Model
{
    use HasFactory;

    protected $table = "channel_emissions";

    protected $fillable = [
        'satellite_image_id',
        'channel_number',
        'filename',
        'path'
    ];

    public function satelliteImage()
    {
        return $this->belongsTo(SatelliteImage::class);
    }

    public function channelEmissionData()
    {
        return $this->hasMany(ChannelEmissionData::class);
    }

    protected static function booted()
    {
        static::deleting(function (ChannelEmission $channel_emission) {
            $channel_emission->channelEmissionData()->delete();
        });
    }
}

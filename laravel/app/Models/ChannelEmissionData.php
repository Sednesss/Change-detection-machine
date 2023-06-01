<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelEmissionData extends Model
{
    use HasFactory;

    protected $table = "channel_emissions_data";

    protected $fillable = [
        'channel_emission_id',
        'position',
        'data'
    ];

    public function channelEmission()
    {
        return $this->belongsTo(ChannelEmission::class);
    }
}

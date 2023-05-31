<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultProcessing extends Model
{
    use HasFactory;

    protected $table = "result_processings";

    protected $fillable = [
        'project_id',
        'link'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

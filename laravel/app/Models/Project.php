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
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

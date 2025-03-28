<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $fillable = [
        'title',
        'category',
        'year',
        'file_path'
    ];

    protected $casts = [
        'year' => 'integer'
    ];
}

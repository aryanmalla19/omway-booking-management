<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'image_path',
        'imageable_id',
        'imageable_type',
    ];
}

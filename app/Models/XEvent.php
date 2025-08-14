<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XEvent extends Model
{
    protected $fillable = [
        'title',
        'type',
        'category_id',
        'description',
        'about',
        'start_time',
        'end_time',
        'location',
        'image_link',
        'organizer_id',
    ];
}

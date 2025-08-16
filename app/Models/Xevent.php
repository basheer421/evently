<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xevent extends Model
{
    use HasFactory;

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    // If your table name is not "advertisements", uncomment and change the line below
    // protected $table = 'your_table_name';

    // Fields you want to allow for mass assignment
    protected $fillable = [
        'image',   // e.g., "images/banner1.jpg"
        'mobile_image',   // e.g., "images/banner1.jpg"
        'title',    // optional
        'link',     // optional (where ad redirects to)
        'is_active' // optional for status
    ];
}

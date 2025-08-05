<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $fillable = [
        'name', 'slug', 'image', 'is_active'
    ];
      protected $casts = [
        'images' => 'array'
    ];


    public function products(){
        return $this->hasMany(Product::class);
    }

}

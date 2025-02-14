<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'name',
        'slug',

    ];
    function posts()
    {
        return $this->hasMany(Post::class);
    }
}

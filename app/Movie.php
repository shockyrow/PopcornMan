<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'imgUrl',
        'about',
        'year',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function keywords()
    {
        return $this->belongsToMany(Keyword::class);
    }
}

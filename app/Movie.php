<?php

namespace App;

use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model implements LikeableContract
{
    use Likeable;

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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

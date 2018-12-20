<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $fillable = [
        'Title', 'Description', 'ImageURL', 'Rating', 'Genre', 'ReleaseYear', 'GrossProfit','Director','MainActorsList',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'type', 'genre', 'rating'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

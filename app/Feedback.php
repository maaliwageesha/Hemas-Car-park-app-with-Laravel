<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $guarded = [];

    public function parking()
    {
        return $this->belongsTo('App\Parking');
    }
}

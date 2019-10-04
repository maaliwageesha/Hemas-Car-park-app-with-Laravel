<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['user_id', 'status_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

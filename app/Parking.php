<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $fillable = ['slot_id', 'name', 'email', 'phone_number', 'status_id', 'reservation_code'];

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    public function feedback()
    {
        return $this->hasOne('App\Feedback');
    }

    // public function messages()
    // {
    //     return $this->belongsToMany('App\Message')->withTimestamps();
    // }
}

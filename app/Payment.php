<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['parking_id', 'status_id', 'charges', 'name', 'phone_number', 'reservation_code'];

    public function parking()
    {
        return $this->belongsTo('App\Parking');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['slot_id', 'name', 'phone_number', 'email', 'status_id', 'reserved_time', 'expires_in', 'reservation_code'];
}

<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */
/**@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ auto generates @@@@@@@@@@@@@@@@@@@@@@@@@@@@ */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Slot::class, function (Faker $faker) {
    static $id = 1;
    return [
        'slot_name' => 'Block '. $id++,
        'status_id' => 0
    ];
});

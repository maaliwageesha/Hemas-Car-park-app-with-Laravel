<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([[
            'type_name' => 'Doctor',
            'chargePerHour' => 350,
         ]
        , [
            'type_name' => 'Nurse',
            'chargePerHour' => 150,
        ],
        [
            'type_name' => 'Attendant',
            'chargePerHour' => 50,
        ],
        [
            'type_name' => 'Regular',
            'chargePerHour' => 40,
        ]
        ]);
    }
}

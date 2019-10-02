<?php

use Illuminate\Database\Seeder;

class SlotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Slot::class, 24)->create();
    }
}

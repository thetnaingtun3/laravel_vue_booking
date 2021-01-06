<?php

use Illuminate\Database\Seeder;

class BookalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Bookable::class,100)->create();
    }
}

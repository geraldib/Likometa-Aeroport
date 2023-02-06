<?php

use App\Trip;
use Illuminate\Database\Seeder;

class TripsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trip::create([
            'st_location' => 'rinas',
            'end_location' => 'fier',
            'empty_seats' => 12,
            'price' => 12000,
        ]);

        Trip::create([
            'st_location' => 'fier',
            'end_location' => 'rinas',
            'empty_seats' => 14,
            'price' => 10000,
        ]);
    }
}

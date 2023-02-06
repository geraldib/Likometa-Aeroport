<?php

use App\Hour;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Hour::create([
            'st_time' => Carbon::parse("07:00:00"),
            'trip_id' => 1,
        ]);

        Hour::create([
            'st_time' => Carbon::parse("08:00:00"),
            'trip_id' => 1,
        ]);
        Hour::create([
            'st_time' => Carbon::parse("09:00:00"),
            'trip_id' => 1,
        ]);
        Hour::create([
            'st_time' => Carbon::parse("09:00:00"),
            'trip_id' => 2,
        ]);
        Hour::create([
            'st_time' => Carbon::parse("10:00:00"),
            'trip_id' => 2,
        ]);
        Hour::create([
            'st_time' => Carbon::parse("11:00:00"),
            'trip_id' => 2,
        ]);

    }
}

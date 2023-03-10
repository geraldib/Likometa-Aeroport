<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RoadsTableSeeder::class);
        $this->call(TripsTableSeeder::class);
        $this->call(HoursTableSeeder::class);
        $this->call(AgesTableSeeder::class);
    }
}

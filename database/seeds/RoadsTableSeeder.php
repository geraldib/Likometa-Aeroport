<?php

use App\Road;
use Illuminate\Database\Seeder;

class RoadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Road::create([
            'name' => 'rinas',
        ]);
        Road::create([
            'name' => 'fier',
        ]);
    }
}

<?php

use App\Age;
use Illuminate\Database\Seeder;

class AgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Age::create([
            'name' => 'Adult',
            'percentage' => 100,
        ]);
        Age::create([
            'name' => 'Femije',
            'percentage' => 75,
        ]);
        Age::create([
            'name' => 'Foshnje',
            'percentage' => 0,
        ]);
    }
}

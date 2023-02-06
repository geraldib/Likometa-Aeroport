<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class, 10)->create()->each(function ($u) {
            $u->save();
        });

        User::create([
            'name' => 'Gerald',
            'surname' => 'Ibra',
            'email' => 'geri.ibra@gmail.com',
            'number' => '0697290241',
            'email_verified_at' => now(),
            'password' => Hash::make('sk8terboi'),
            'role' => 'a',
        ]);

        User::create([
            'name' => 'Enerisa',
            'surname' => 'Ibra',
            'email' => 'geraldibra@gmail.com',
            'number' => '0697290241',
            'email_verified_at' => now(),
            'password' => Hash::make('sk8terboi'),
            'role' => 'u',
        ]);

    }
}

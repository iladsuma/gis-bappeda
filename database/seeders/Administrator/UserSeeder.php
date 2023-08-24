<?php

namespace Database\Seeders\Administrator;

use App\Models\Administrator\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();
        $user = User::create([
            'opd_id' => 1,
            'name' => 'Iman Ghazali',
            'username' => 'administrator',
            'email' => 'administrator@test',
            'password' => bcrypt('password'),
            'avatar' => 'avatar-default.png',
        ]);
    }
}

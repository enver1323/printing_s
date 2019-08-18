<?php

use App\Domain\User\Entities\User;
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
        User::firstOrCreate([
            'name' => 'admin',
            'email' => 'enver1323@gmail.com',
            'password' => bcrypt('cderfv34'),
            'role' => User::ROLE_ADMIN,
        ]);
    }
}

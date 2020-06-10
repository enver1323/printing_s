<?php

use App\Domain\User\Entities\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'enver1323',
            'email' => 'enver1323@gmail.com',
            'password' => '$2y$10$FcNxV1IzIutwe0uL51yCOujF627DXi0pDiBZYkRlaO6B8Kie5dXUm', // cderfv34
            'remember_token' => 'sNjxc0jZyL',
            'role' => User::ROLE_ADMIN,
        ]);
    }
}

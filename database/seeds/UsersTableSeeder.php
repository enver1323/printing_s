<?php

use App\Domain\User\Entities\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            'name' => 'enver1323',
            'email' => 'enver1323@gmail.com',
            'email_verified_at' => time(),
            'password' => '$2y$10$FcNxV1IzIutwe0uL51yCOujF627DXi0pDiBZYkRlaO6B8Kie5dXUm', // cderfv34
            'remember_token' => Str::random(10),
            'role' => User::ROLE_ADMIN,
            'verify_token' => Str::random(10),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
//        factory(User::class, 10)->create();
    }
}

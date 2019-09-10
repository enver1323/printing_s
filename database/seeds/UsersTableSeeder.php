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
            'password' => '$2y$10$FcNxV1IzIutwe0uL51yCOujF627DXi0pDiBZYkRlaO6B8Kie5dXUm', // cderfv34
            'remember_token' => Str::random(10),
            'role' => User::ROLE_ADMIN,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        User::insert([
            'name' => 'stitsyuk',
            'email' => 'stitsyuk@mail.ru',
            'password' => bcrypt('stivengerrard'),
            'remember_token' => Str::random(10),
            'role' => User::ROLE_ADMIN,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
//        factory(User::class, 10)->create();
    }
}

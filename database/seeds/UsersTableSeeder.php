<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$jYMq3ikCAsblTTwz.Dt5luhFZKiMLdFUQAX7/.0NhESYutTY/0zg.',
        ]);
    }
}

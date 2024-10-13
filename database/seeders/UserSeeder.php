<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@mail.com',
            'password' => bcrypt('admin@mail.com'),
            'level' => 2,
        ]);
        $teacher = User::create([
            'name'     => 'Teacher',
            'email'    => 'teacher@mail.com',
            'password' => bcrypt('teacher@mail.com'),
            'level' => 1,
        ]);
        $teacher2 = User::create([
            'name'     => 'Teacher2',
            'email'    => 'teacher2@mail.com',
            'password' => bcrypt('teacher2@mail.com'),
            'level' => 1,
        ]);
        User::factory()->count(25)->create();
    }
}

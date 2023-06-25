<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        //akun seeder
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'username' => 'user',
            'email' => 'meyzan16051@gmail.com',
            'password' => bcrypt('aa'),
            'roles' => '0',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test admin',
            'username' => 'admin',
            'email' => 'meyzan1605@gmail.com',
            'password' => bcrypt('aa'),
            'roles' => '1',
        ]);
    }
}

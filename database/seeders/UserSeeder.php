<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Istrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ])->assignRole('admin');

        User::factory()->create([
            'first_name' => 'User',
            'last_name' => 'Name',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
        ]);
    }
}

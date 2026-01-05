<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //Create a test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@ecommerce.com',
            'password' => Hash::make('password'),
        ]);
        
        //Create an admin user
        User::firstOrCreate(
            ['email' => 'admin@ecommerce.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );
    }
}
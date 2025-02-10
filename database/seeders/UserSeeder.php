<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i <= 4; $i++) { 
            \App\Models\User::factory()->create([
                'name' => 'User '. $i,
                'email' => 'user'. $i .'@example.com',
                'password' => 'password',
            ]);
        }
        
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Tag::factory()->create([
            'name' => 'News',
        ]);
        \App\Models\Tag::factory()->create([
            'name' => 'Entertaintment',
        ]);
        \App\Models\Tag::factory()->create([
            'name' => 'Funny',
        ]);
        \App\Models\Tag::factory()->create([
            'name' => 'Animal',
        ]);
        \App\Models\Tag::factory()->create([
            'name' => 'Crime',
        ]);
    }
}

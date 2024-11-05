<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Event;
use App\Models\Category;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password'=> bcrypt('12345678'),
            'rol' => 'a',
            'actived' => 1,
            'email_confirmed' => 1,
            'image'=>""

        ]);
        User::factory()->create([
            'name' => 'org',
            'email' => 'org@gmail.com',
            'password'=> bcrypt('12345678'),
            'rol' => 'o',
            'actived' => 1,
            'email_confirmed' => 1,
            'image'=>""

        ]);

        $categories = [
            [
                'name' => 'Music',
                'description' => 'All events related to music, concerts, and performances.',
                'deleted' => 0,
            ],
            [
                'name' => 'Sport',
                'description' => 'Events that involve sports, competitions, and physical activities.',
                'deleted' => 0,
            ],
            [
                'name' => 'Tech',
                'description' => 'Technology-related events, including workshops and conferences.',
                'deleted' => 0,
            ],
        ];

        
        DB::table('categories')->insert($categories);

        Event::factory(10)->create();

        User::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
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

        /*User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password'=> bcrypt('12345678'),
            'rol' => 'a',
            'actived' => 1,
            'email_confirmed' => 1,
            'image'=>""

        ]);*/
        /*User::factory()->create([
            'name' => 'org',
            'email' => 'org@gmail.com',
            'password'=> bcrypt('12345678'),
            'rol' => 'o',
            'actived' => 1,
            'email_confirmed' => 1,
            'image'=>""

        ]);*/

        //Event::factory()->count(5)->create();

        //User::factory(10)->create();
    }
}

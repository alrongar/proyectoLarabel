<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
            'name' => 'administrador',
            'email' => 'administrador@gmail.com',
            'password'=> bcrypt('administrador'),
            'rol' => 'a',
            'actived' => 1,
            'email_confirmed' => 1,
            'image'=>""

        ]);

        User::factory(10)->create();
    }
}

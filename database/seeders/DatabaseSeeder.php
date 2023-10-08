<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Gender;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //creo un usuario de pruaba
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make("123456789")
        ]);
        //creo 20 generos musicales 
        Gender::factory(20)->create();
        //creo 100 artistas y relaciono a un genero
        Artist::factory(100)->create();
        //creo 10 albunes 
        Album::factory(10)->create();
        //creo 200 canciones relacinadas a artistas y albunes
        Song::factory(200)->create();
    }
}

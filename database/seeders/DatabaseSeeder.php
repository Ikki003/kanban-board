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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(EstadosSeeder::class);
        $this->call(PrioridadesSeeder::class);
        $this->call(ProyectosSeeder::class);
        $this->call(UsuariosProyectosSeeder::class);
        $this->call(TareasSeeder::class);
        $this->call(EstadosNotificacionesSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Usuario_Proyecto;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosProyectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario_Proyecto::truncate();

        DB::table('usuarios_proyectos')->insert([
            'user_id' => 1,
            'proyecto_id' => 1, 
            'created_at' => Carbon::now(),
        ]);

        DB::table('usuarios_proyectos')->insert([
            'user_id' => 1,
            'proyecto_id' => 2, 
            'created_at' => Carbon::now(),
        ]);

        DB::table('usuarios_proyectos')->insert([
            'user_id' => 1,
            'proyecto_id' => 3, 
            'created_at' => Carbon::now(),
        ]);
    }
}

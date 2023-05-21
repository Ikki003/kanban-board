<?php

namespace Database\Seeders;

use App\Models\Prioridad;
use App\Models\Proyecto;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        Proyecto::truncate();

        DB::table('proyectos')->insert([
            'name' => 'Proyecto de prueba',
            'description' => 'Esta es la descripcion del proyecto de prueba',
            'responsable_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('proyectos')->insert([
            'name' => 'Proyecto de prueba2',
            'description' => 'Esta es la descripcion del proyecto de prueba2',
            'responsable_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('proyectos')->insert([
            'name' => 'Proyecto de prueba3',
            'description' => 'Esta es la descripcion del proyecto de prueba3',
            'responsable_id' => 2,
            'created_at' => Carbon::now(),
        ]);

        DB::table('prioridades')->insert([
            'name' => 'Media',
            'created_at' => Carbon::now(),
        ]);

        DB::table('prioridades')->insert([
            'name' => 'Alta',
            'created_at' => Carbon::now(),
        ]);

    }
}

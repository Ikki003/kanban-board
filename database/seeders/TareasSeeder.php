<?php

namespace Database\Seeders;

use App\Models\Tarea;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TareasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tarea::truncate();

        DB::table('tareas')->insert([
            'name' => 'Tarea 1',
            'description' => 'Esta es la descripcion del proyecto de la tarea 1',
            'start_date' => '2023-04-15',
            'end_date' => '2023-05-15',
            'proyecto_id' => 1,
            'estado_id' => 1,
            'prioridad_id' => 1,
            'responsable_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('tareas')->insert([
            'name' => 'Tarea 2',
            'description' => 'Esta es la descripcion del proyecto de la tarea 2',
            'start_date' => '2023-02-15',
            'end_date' => '2023-05-17',
            'proyecto_id' => 2,
            'estado_id' => 1,
            'prioridad_id' => 1,
            'responsable_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('tareas')->insert([
            'name' => 'Tarea 3',
            'description' => 'Esta es la descripcion del proyecto de la tarea 3',
            'start_date' => '2023-02-15',
            'end_date' => '2023-05-17',
            'proyecto_id' => 2,
            'estado_id' => 2,
            'prioridad_id' => 1,
            'responsable_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('tareas')->insert([
            'name' => 'Tarea 4',
            'description' => 'Esta es la descripcion del proyecto de la tarea 4',
            'start_date' => '2023-02-15',
            'end_date' => '2023-05-17',
            'proyecto_id' => 2,
            'estado_id' => 2,
            'prioridad_id' => 1,
            'responsable_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('tareas')->insert([
            'name' => 'Tarea 5',
            'description' => 'Esta es la descripcion del proyecto de la tarea 5',
            'start_date' => '2023-02-15',
            'end_date' => '2023-05-17',
            'proyecto_id' => 3,
            'estado_id' => 1,
            'prioridad_id' => 1,
            'responsable_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('tareas')->insert([
            'name' => 'Tarea 6',
            'description' => 'Esta es la descripcion del proyecto de la tarea 6',
            'start_date' => '2023-02-15',
            'end_date' => '2023-05-17',
            'proyecto_id' => 1,
            'estado_id' => 4,
            'prioridad_id' => 1,
            'responsable_id' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}

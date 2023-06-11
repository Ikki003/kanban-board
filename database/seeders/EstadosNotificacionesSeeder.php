<?php

namespace Database\Seeders;

use App\Models\EstadoNotificacion;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosNotificacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoNotificacion::truncate();

        DB::table('estados_notificaciones')->insert([
            'name' => 'Pendiente',
            'slug' => 'pendiente',
            'created_at' => Carbon::now(),
        ]);

        DB::table('estados_notificaciones')->insert([
            'name' => 'Aceptada',
            'slug' => 'aceptada',
            'created_at' => Carbon::now(),
        ]);

        DB::table('estados_notificaciones')->insert([
            'name' => 'Cancelada',
            'slug' => 'cancelada',
            'created_at' => Carbon::now(),
        ]);
    }
}

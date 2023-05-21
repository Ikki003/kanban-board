<?php

namespace Database\Seeders;

use App\Models\Prioridad;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioridadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prioridad::truncate();

        DB::table('prioridades')->insert([
            'name' => 'Baja',
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

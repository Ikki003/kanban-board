<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Estado;
use Carbon\Carbon;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Estado::truncate();

        DB::table('estados')->insert([
            'name' => 'Por hacer',
            'created_at' => Carbon::now(),
        ]);

        DB::table('estados')->insert([
            'name' => 'En curso',
            'created_at' => Carbon::now(),
        ]);

        DB::table('estados')->insert([
            'name' => 'En review',
            'created_at' => Carbon::now(),
        ]);

        DB::table('estados')->insert([
            'name' => 'Finalizada',
            'created_at' => Carbon::now(),
        ]);
    }
}

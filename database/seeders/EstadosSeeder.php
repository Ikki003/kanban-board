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
            'color' => 'bg-yellow-300',
            'created_at' => Carbon::now(),
        ]);

        DB::table('estados')->insert([
            'name' => 'En curso',
            'color' => 'bg-blue-300',
            'created_at' => Carbon::now(),
        ]);

        DB::table('estados')->insert([
            'name' => 'En review',
            'color' => 'bg-purple-300',
            'created_at' => Carbon::now(),
        ]);

        DB::table('estados')->insert([
            'name' => 'Finalizada',
            'color' => 'bg-green-300',
            'created_at' => Carbon::now(),
        ]);
    }
}

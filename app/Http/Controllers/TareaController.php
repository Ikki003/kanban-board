<?php

namespace App\Http\Controllers;
use App\Models\Tarea;

use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function edit(Tarea $tarea) {

        if(!$tarea) {
            return null;
        }

        return [
            'tarea' => $tarea
        ];

        // return view('Tareas.edit', compact('tarea'));
    }

}

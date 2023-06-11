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

    public function update(Tarea $tarea, Request $request) {

        if($request->modo == 'ondrop') {
            $tarea->estado_id = $request->state_id;
            $tarea->save();
            
            return response()->json(['ok'=>true]);
        }

        $tarea->update($request->all());

        return redirect()->back();
        
        
    }

    public function show(Tarea $tarea) {

    }

}

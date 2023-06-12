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

    public function update(Request $request, Tarea $tarea) {

        if($request->modo == 'ondrop') {
            $tarea->estado_id = $request->state_id;
            $tarea->save();
            
            return response()->json(['ok'=>true]);
        }

        $tarea->update($request->all());

        return redirect()->back();   
        
    }

    public function store(Request $request) {

        $tarea = new Tarea;
        $tarea->name = $request->name;
        $tarea->description = $request->description;
        $tarea->estado_id = $request->estado_id;
        $tarea->prioridad_id = $request->prioridad_id;
        $tarea->proyecto_id = $request->proyecto_id;
        $tarea->responsable_id = auth()->user()->id;
        $tarea->save();
        // $tarea->create($request->all());

        return redirect()->back();
        
        
    }

    public function show(Tarea $tarea) {

    }

}

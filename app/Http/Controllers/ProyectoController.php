<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Prioridad;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index() {

        $proyectos = auth()->user()->proyectos;

        return view('Proyectos.index', compact('proyectos'));
    }

    // public function show(Proyecto $proyecto) {

    //     $tareas = $proyecto->tareas;

    //     $estados = Estado::all();
    //     $prioridades = Prioridad::all();

    //     return view('Proyectos.show', compact('tareas', 'estados', 'proyecto', 'prioridades'));
    // }

    public function addMember() {
        
    }
}

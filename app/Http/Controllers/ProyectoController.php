<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Prioridad;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\Usuario_Proyecto;

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

    public function store(Request $request) {

        $proyecto = new Proyecto;
        $proyecto->name = $request->project_name;
        $proyecto->description = $request->project_description;
        $proyecto->responsable_id = auth()->user()->id;
        $proyecto->save();

        $id_ultimo_proyecto = Proyecto::latest()->first()->id;

        $usuario_proyecto = new Usuario_Proyecto;
        $usuario_proyecto->user_id = auth()->user()->id;
        $usuario_proyecto->proyecto_id = $id_ultimo_proyecto;
        $usuario_proyecto->save();

        // public function search(Request $request){

        //     if( $request->has('filtro') ) {
        //         session()->put("filtro_nombre", $request->filtro);
        //     }
        //
        //  if( $request->has('filtro') ) {
        //    session()->put("filtro_nombre", null);
        //
        //  return('/index);
        //
        // cojo variable de sesion en el index y devuelvo con filtros. devolver con value en el filtro
        //

        return redirect()->back()->with('success', 'Proyecto creado con éxito');
    }
}

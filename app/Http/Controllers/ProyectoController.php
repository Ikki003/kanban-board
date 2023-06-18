<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Notificacion;
use App\Models\Prioridad;
use App\Models\Proyecto;
use App\Models\Tarea;
use Illuminate\Http\Request;
use App\Models\Usuario_Proyecto;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\throwException;

class ProyectoController extends Controller
{
    public function index() {

        $session = session()->get("SProjectName");

        $proyectos = auth()->user()->proyectos;

        if($session) {
            $proyectos = $proyectos->filter(function ($proyecto) use($session){
                return strpos($proyecto->name, $session) !== false;
            });
        }

        return view('Proyectos.index', compact('proyectos'));
    }

    // public function show(Proyecto $proyecto) {

    //     $tareas = $proyecto->tareas;

    //     $estados = Estado::all();
    //     $prioridades = Prioridad::all();

    //     return view('Proyectos.show', compact('tareas', 'estados', 'proyecto', 'prioridades'));
    // }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'project_description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Se ha producido un error. Comprueba los datos.');
        }

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

        return redirect()->back()->with('success', 'Proyecto creado con éxito');
    }

    public function search(Request $request) {

        session()->put("SProjectName", $request->search_project_input);

        if(!$request->search_project_input) {
            session()->put("SProjectName", null);
        }

        return redirect()->route("proyectos.index");
    }

    public function destroy(Request $request, $proyecto_id) {
        Proyecto::where('id', $proyecto_id)->delete();
        Tarea::where('proyecto_id', $proyecto_id)->delete();
        Notificacion::where('project_id', $proyecto_id)->delete();

        return redirect()->route("proyectos.index")->with('success', 'Proyecto eliminado correctamente');
    }

    public function update(Request $request, $proyecto_id) {
       
        $proyecto = Proyecto::findOrFail($proyecto_id);

        if(!$proyecto) {
            throw new \Exception("No se ha encontrado el proyecto con id ".$proyecto_id);
        }

        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'project_description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'No se ha podido guardar el proyecto. Rellena todos los datos.');
        }

        $data = ['name' => $request->project_name, 'description' => $request->project_description];

        $proyecto->update($data);

        return redirect()->back()->with('success', 'Proyecto actualizado');
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\Prioridad;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

class TareaController extends Controller
{

    public function index(Proyecto $proyecto) {
        $tareas = $proyecto->tareas;

        $estados = Estado::all();
        $prioridades = Prioridad::all();

        return view('Tareas.index', compact('tareas', 'estados', 'proyecto', 'prioridades'));
    }

    public function edit($id) {

        $tarea = Tarea::findOrFail($id);
        $estados = Estado::all();
        $prioridades = Prioridad::all();

        if(!$tarea) {
            return null;
        }

        return [
            'tarea' => $tarea,
            'proyecto_id' => $tarea->proyecto->id,
        ];
    }

    public function update(Request $request) {

        if($request->modo == 'ondrop') {
            $tarea = Tarea::findOrFail($request->task_id);
            $tarea->estado_id = $request->state_id;
            $tarea->save();
            
            return response()->json(['ok'=>true]);
        }

        $tarea = Tarea::findOrFail($request->tarea_id);

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


    public function setTime(Request $request) {

        $time = $request->hours;

        $interval = CarbonInterval::fromString($time);
        $seconds = $interval->total('seconds');
        
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
        
        $carbon = Carbon::createFromTime($hours, $minutes, $seconds);
        // Extraer los componentes del tiempo

        var_dump($carbon->toTimeString());

        

    }

}

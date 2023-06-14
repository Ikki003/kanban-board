<?php

namespace App\Http\Controllers;
use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\Prioridad;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TareaController extends Controller
{

    public function index(Proyecto $proyecto) {
        $tareas = $proyecto->tareas;

        $estados = Estado::all();
        $prioridades = Prioridad::all();

        return view('Tareas.index', compact('tareas', 'estados', 'proyecto', 'prioridades'));
    }

    public function edit($proyecto_id, $id) {

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

        $validator = Validator::make($request->all(), [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validator->fails()) {
            // Si la validación falla, redirecciona o devuelve una respuesta con los errores
            return redirect()->back()->with('error', 'Hay un eror en la fecha.');
        }

        $tarea->update($request->all());

        return redirect()->back()->with('success', 'Tarea actualizada correctamente');   
        
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


    public function setTime(Request $request, $id, $id_tarea) {
    
        $tarea = Tarea::findOrFail($id_tarea);

        $time = $request->hours;
        $time2 = $request->estimated_hours;

        if($time && !$time2) {
            if(!$tarea->estimated_hours) {
                return redirect()->back()->with('error', 'Necesitas asignar unas horas estimadas');
            }
        }

        $formattedTime = Tarea::parseTime($time);
        
        if($time2) {
            $formatted_time2 = Tarea::parseTime($time2);
            $formatted_time2 = $formatted_time2->toTimeString();
            $tarea->estimated_hours = $formatted_time2;
        }

        if($tarea->hours) {
            $tareaTime = Carbon::parse($tarea->hours);

            $formattedTime->addHours($tareaTime->hour);
            $formattedTime->addMinutes($tareaTime->minute);
            $formattedTime->addSeconds($tareaTime->second);
            $formattedTime = $formattedTime->toTimeString();
        }

        $tarea->hours = $formattedTime;
        $tarea->save();

        // mandar mensaje de cuidado si el numero de horas es mayor a las asignadas

        return redirect()->back();

    }
}

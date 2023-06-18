<?php

namespace App\Http\Controllers;
use App\Models\Tarea;
use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\EstadoNotificacion;
use App\Models\Notificacion;
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
        $auth_user = auth()->user()->name;

        if($request->task_id) {
            $tarea_id = $request->task_id;
        } else {
            $tarea_id = $request->tarea_id;
        }

        $tarea = Tarea::findOrFail($tarea_id);
        $tarea_responsable_before = $tarea->responsable_id;

        if($request->modo == 'ondrop') {
            $tarea->estado_id = $request->state_id;
            $tarea->save();
            
            return response()->json(['ok'=>true]);
        }

        $validator = Validator::make($request->all(), [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'prioridad_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Se ha producido un error. Comprueba los datos.');
        }

        if($tarea_responsable_before != $request->responsable_id) {
            $notificacion = new Notificacion;
            $notificacion->message = __("$auth_user te ha asignado la tarea '$tarea->name'");
            $notificacion->user_sender_id = auth()->user()->id;
            $notificacion->read = 0;
            $notificacion->user_receptor_id = $request->responsable_id;
            $notificacion->project_id = $tarea->proyecto->id;
            $notificacion->estado_notificacion_id = EstadoNotificacion::ESTADO_PRIVADA;
            $notificacion->save();
        }

        $tarea->update($request->all());

        return redirect()->back()->with('success', 'Tarea actualizada correctamente');   
        
    }

    public function store(Request $request) {

        if(!$request->prioridad_id) {
            return redirect()->back()->with('error', 'El campo prioridad es obligatorio');
        }

        $tarea = new Tarea;
        $tarea->name = $request->name;
        $tarea->description = $request->description;
        $tarea->estado_id = $request->estado_id;
        $tarea->prioridad_id = $request->prioridad_id;
        $tarea->proyecto_id = $request->proyecto_id;
        $tarea->responsable_id = auth()->user()->id;
        $tarea->save();
        // $tarea->create($request->all());

        return redirect()->back()->with('success', 'Tarea creada correctamente');
        
        
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

        return redirect()->back()->with('success', 'Tarea actualizada correctamente');

    }

    public function destroy(Request $request, $proyecto_id, $tarea_id) {
        Tarea::where('id', $tarea_id)->delete();

        return redirect()->back()->with('success', 'Tarea eliminada correctamente');
    }
}

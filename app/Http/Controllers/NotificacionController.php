<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Models\EstadoNotificacion;
use App\Models\User;
use App\Models\Proyecto;
use Carbon\Carbon;

class NotificacionController extends Controller
{
    public function index(){

        $auth_user = auth()->user()->id;

        $estados_notificaciones = EstadoNotificacion::all()->pluck('id', 'name');

        $estados_notificaciones = $estados_notificaciones->prepend('all', 'Todos');

        $session = session()->get("SNotificationState");

        $notifications = Notificacion::where('user_sender_id', $auth_user)
            ->orWhere('user_receptor_id', $auth_user)
            ->get();

        if($session && $session != EstadoNotificacion::ESTADO_ALL) {
            $notifications = $notifications->where('estado_notificacion_id', $session);
        }

        return view('Notifications.index', compact('notifications', 'estados_notificaciones'));
    }

    public static function sendNotification(Request $request) {

        if($request->modo == 'joinproject') {
            $notificacion = new Notificacion;

            $user = User::findOrFail($request->user_receptor);
            $is_user_already_in_project = $user->proyectos()->where('proyecto_id', $request->proyecto_id_join)->get();

            if(count($is_user_already_in_project) !== 0) {
                return response()->json(['error' => 'El usuario ya está unido al proyecto']);
            }

            $sender = User::findOrFail($request->auth_user);
            $sender_name = $sender->name;

            $project = Proyecto::findOrFail($request->proyecto_id_join);
            $project_name = $project->name;

            $notificacion->message = __("$sender_name te ha invitado al proyecto '$project_name'");
            $notificacion->user_sender_id = $request->auth_user;
            $notificacion->user_receptor_id = $request->user_receptor;
            $notificacion->project_id = $request->proyecto_id_join;
            $notificacion->read = 0;
            $notificacion->estado_notificacion_id = EstadoNotificacion::ESTADO_PENDIENTE;
            $notificacion->save();
        }

        return redirect()->back();
    }

    public function search(Request $request) {

        if($request->filter_state_input == EstadoNotificacion::ESTADO_ALL) {
            session()->put("SNotificationState", null);
        } else {
            session()->put("SNotificationState", $request->filter_state_input);
        }

        return redirect()->route("notifications.index");
    }

    // public function read(Request $request) {
    //     Notificacion::where('user_id', auth()->user()->id)->update(['read' => 1]);

    //     return redirect()->back()->with('success', 'Notificaciones leídas');
    // }
}

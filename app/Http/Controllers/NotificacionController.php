<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Models\EstadoNotificacion;
use App\Models\User;
use App\Models\Proyecto;

class NotificacionController extends Controller
{
    public function index(){

        $auth_user = auth()->user()->id;

        $notifications = Notificacion::where('user_sender_id', $auth_user)
            ->orWhere('user_receptor_id', $auth_user)
            ->get();

        return view('Notifications.index', compact('notifications'));
    }

    public static function sendNotification(Request $request) {

        if($request->modo == 'joinproject') {
            $notificacion = new Notificacion;

            $sender = User::findOrFail($request->auth_user);
            $sender_name = $sender->name;

            $project = Proyecto::findOrFail($request->proyecto_id_join);
            $project_name = $project->name;

            $notificacion->message = __("$sender_name te ha invitado al proyecto '$project_name'");
            $notificacion->user_sender_id = $request->auth_user;
            $notificacion->user_receptor_id = $request->user_receptor;
            $notificacion->project_id = $request->proyecto_id_join;
            $notificacion->estado_notificacion_id = EstadoNotificacion::ESTADO_PENDIENTE;
            $notificacion->save();
        }

        $notificacion = new Notificacion;

        $sender = User::findOrFail($request->auth_user);
        $sender_name = $sender->name;

        $project = Proyecto::findOrFail($request->proyecto_id_join);
        $project_name = $project->name;

        $notificacion->message = __("$sender_name te ha invitado al proyecto '$project_name'");
        $notificacion->user_sender_id = $request->auth_user;
        $notificacion->user_receptor_id = $request->user_receptor;
        $notificacion->project_id = $request->proyecto_id_join;
        $notificacion->estado_notificacion_id = EstadoNotificacion::ESTADO_PENDIENTE;
        $notificacion->save();

        return redirect()->back();
    }
}

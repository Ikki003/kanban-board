<?php

namespace App\Http\Controllers;

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

        $notifications = Notificacion::where('user_sender_id', $auth_user)
            ->orWhere('user_receptor_id', $auth_user)
            ->get();

        return view('Notifications.index', compact('notifications'));
    }

    public static function sendNotification(Request $request) {

        if($request->modo == 'joinproject') {
            $notificacion = new Notificacion;

            $user = User::findOrFail($request->user_receptor);
            $is_user_already_in_project = $user->proyectos()->where('proyecto_id', $request->user_receptor)->get();

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
            $notificacion->estado_notificacion_id = EstadoNotificacion::ESTADO_PENDIENTE;
            $notificacion->save();

            // $copia = clone $notificacion;
            // $copia->user_receptor_id = $request->auth_user;
            // $copia->save();

            // $notificacion2 = new Notificacion;
            // $project_name = $project->name;

            // $receptor = User::findOrFail($request->user_receptor);

            // if(!$receptor) {
            //     throw new \Exception('No se ha encontrado el usuario con id '.$request->user_receptor);
            // }

            // $receptor_name = $receptor->name;

            // $notificacion2->message = __("Has invitado a $receptor_name al proyecto '$project_name");
            // $notificacion2->user_sender_id = $request->auth_user;
            // $notificacion2->user_receptor_id = $request->auth_user;
            // $notificacion2->project_id = $request->proyecto_id_join;
            // $notificacion2->estado_notificacion_id = EstadoNotificacion::ESTADO_PRIVADA;
            // $notificacion2->save();
        }

        // $notificacion = new Notificacion;

        // $sender = User::findOrFail($request->auth_user);
        // $sender_name = $sender->name;

        // $project = Proyecto::findOrFail($request->proyecto_id_join);
        // $project_name = $project->name;

        // $notificacion->message = __("$sender_name te ha invitado al proyecto '$project_name'");
        // $notificacion->user_sender_id = $request->auth_user;
        // $notificacion->user_receptor_id = $request->user_receptor;
        // $notificacion->project_id = $request->proyecto_id_join;
        // $notificacion->estado_notificacion_id = EstadoNotificacion::ESTADO_PENDIENTE;
        // $notificacion->save();

        return redirect()->back();
    }
}

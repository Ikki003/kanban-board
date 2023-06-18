<?php

namespace App\Http\Controllers;

use App\Models\EstadoNotificacion;
use App\Models\Notificacion;
use App\Models\Usuario_Proyecto;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use App\Models\User;

class UsuarioProyectoController extends Controller
{
    public function store(Request $request) {
        
        if($request->mode == "accept") {
            $usuario_proyecto = new Usuario_Proyecto;

            $user = User::findOrFail($request->data['user_receptor_id']);

            if(!$user) {
                throw new \Exception('No se ha econtrado el usuario con id '.$request->data['user_receptor_id']);
            }

            $usuario_proyecto->user_id = $request->data['user_receptor_id'];
            $usuario_proyecto->proyecto_id = $request->data['project_id'];
            $usuario_proyecto->save();
    
            $notificacion = Notificacion::findOrFail($request->data['id']);
            $notificacion->estado_notificacion_id = EstadoNotificacion::ESTADO_ACEPTADA;
            $notificacion->save();

            return response()->json(['ok'=>true, 'message'=>'Te has unido al proyecto', 'mode'=>'accept']);
        }

        $notificacion = Notificacion::findOrFail($request->data['id']);
        $notificacion->estado_notificacion_id = EstadoNotificacion::ESTADO_CANCELADA;
        $notificacion->save();
       
        return response()->json(['ok'=>true, 'message'=>'Has rechazado la solicitud', 'mode'=>'decline']);
    }
}

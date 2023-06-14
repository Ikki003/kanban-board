<?php

namespace App\Http\Controllers;

use App\Models\EstadoNotificacion;
use App\Models\Notificacion;
use App\Models\Usuario_Proyecto;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class UsuarioProyectoController extends Controller
{
    public function store(Request $request) {
        $usuario_proyecto = new Usuario_Proyecto;

        $decoded_data = json_decode($request->data, true);
        $usuario_proyecto->user_id = $decoded_data->user_receptor_id;
        $usuario_proyecto->proyecto_id = $decoded_data->project_id;
        $usuario_proyecto->save();

        $notificacion = Notificacion::findOrFail($decoded_data->id);
        $notificacion->estado_notificacion_id = EstadoNotificacion::ESTADO_ACEPTADA;
        $notificacion->save();

        // me quedo aqui. tengo que mandar notificacion a usuario de que ha aceptado la peticion
    }
}

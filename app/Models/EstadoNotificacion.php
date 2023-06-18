<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoNotificacion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'estados_notificaciones';

    const ESTADO_PENDIENTE = 1;
    const ESTADO_ACEPTADA = 2;
    const ESTADO_CANCELADA = 3;
    const ESTADO_PRIVADA = 4;
    const ESTADO_ALL = "all";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function notificaciones() {
        return $this->hasMany(Notificacion::class);
    }
}

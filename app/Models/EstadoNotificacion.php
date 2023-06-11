<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoNotificacion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'estados_notificaciones';

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

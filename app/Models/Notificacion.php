<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notificacion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notificaciones';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'user_receiver_id');
    }

    public function estadNotificacion() {
        return $this->belongsTo(EstadoNotificacion::class);
    }
}

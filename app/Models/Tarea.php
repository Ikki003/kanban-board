<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarea extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function proyecto() {
        return $this->belongsTo(Proyecto::class);
    }

    public function estado() {
        return $this->belongsTo(Estado::class);
    }

    public function prioridad() {
        return $this->belongsTo(Prioridad::class);
    }

    public function comentarios() {
        return $this->hasMany(Comentario::class);
    }

    public function subtareas() {
        return $this->hasMany(Subtarea::class);
    }

    public function archivos() {
        return $this->hasMany(Archivo::class);
    }

    public function encargado() {
        return $this->belongsTo(User::class, 'responsable_id');
    }
}

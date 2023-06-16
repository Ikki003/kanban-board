<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function usuarios() {
        return $this->belongsToMany(User::class, 'usuarios_proyectos');
    }

    public function tareas() {
        return $this->hasMany(Tarea::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function getUsers() {
        $proyecto = Proyecto::findOrFail($this->id);
        return $proyecto->usuarios()->pluck('name');
    }

    public function admin() {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function getTareasCount() {
        return $this->tareas->count();
    }
}

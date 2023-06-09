<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function tareas() {
        return $this->hasMany(Tarea::class);
    }

    public function getTasks($proyecto_id) {
        return Tarea::where('estado_id', $this->id)->where('proyecto_id', $proyecto_id)->get();
    }

    public function showTask() {
        $tasks = $this->getTasks($proyecto_id); 
    }

    public function getTasksCount($id) {
        return $this->tareas->where('proyecto_id', $id)->count();
    }
}

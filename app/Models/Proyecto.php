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
}

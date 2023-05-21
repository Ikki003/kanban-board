<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prioridad extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'prioridades';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function tareas() {
        return $this->hasMany(Tarea::class);
    }

}

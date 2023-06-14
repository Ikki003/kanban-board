<?php

use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsuarioProyectoController;
use App\Models\Notificacion;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Welcome.index');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('auth')->group(function () {
    
    // Route::resource('tareas', TareaController::class);
    Route::resource('proyectos', ProyectoController::class);
    Route::post('proyecto/{proyecto}/addmember', [ProyectoController::class, 'addMember'])->name('proyecto.addMember');

    Route::resource('proyectos.tareas', TareaController::class);
    Route::post('proyectos/{proyecto}/tareas/{tarea}/', [TareaController::class, 'update'])->name('proyectos.tareas.update');
    Route::post('proyectos/{proyecto}/tareas/{tarea}/createtime', [TareaController::class, 'setTime'])->name('proyectos.tareas.createTime');
    Route::post('proyectos/{proyecto}/tareas/{tarea}/settime', [TareaController::class, 'setTime'])->name('proyectos.tareas.setTime');

    Route::post('tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update');
    // Route::get('tarea/{tarea}/edit', [TareaController::class, 'edit'])->name('tarea.edit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/getusers', [UserController::class, 'getUsers'])->name('user.getUsers');

    Route::get('notifications', [NotificacionController::class, 'index'])->name('notifications.index');
    Route::post('/sendnotification', [NotificacionController::class, 'sendNotification'])->name('notification.sendNotification');

    Route::resource('usuarios_proyectos', UsuarioProyectoController::class);
});

require __DIR__.'/auth.php';

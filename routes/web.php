<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController; 


Route::resource('tasks', TaskController::class);

// La página de inicio redirige a la vista de tareas
Route::get('/', function () {
    return redirect()->route('tasks.index');
});
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TurnoController;

// web.php (para vistas web)
Route::get('/', [TurnoController::class, 'index']);
Route::get('/turnos/actuales', [TurnoController::class, 'mostrarTurnos']);
Route::get('/turnos/generar', [TurnoController::class, 'mostrarGeneradorTurnos']);
Route::post('/turnos/generar', [TurnoController::class, 'generarTurno']);
Route::post('/turnos/siguiente', [TurnoController::class, 'siguienteTurno']);
Route::get('/ventanilla/{ventanilla}', [TurnoController::class, 'mostrarVentanilla']);
Route::get('/turnos/fetch', [TurnoController::class, 'longPolling']);

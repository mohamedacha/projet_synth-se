<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ReservationController;

// 🔓 Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 🔐 Routes protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // 🔑 Authentification
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // 📦 Catégories
    Route::apiResource('categories', CategorieController::class);

    // 🧼 Services
    Route::apiResource('services', ServiceController::class);

    // 🚗 Véhicules
    Route::apiResource('vehicules', VehiculeController::class);

    // 📅 Réservations
    Route::apiResource('reservations', ReservationController::class);

    // 👤 Client : voir ses propres réservations
    Route::get('/mes-reservations', [ReservationController::class, 'mesReservations']);

    // 🧍 Agent : voir ses tâches du jour
    Route::get('/agent/taches', [ReservationController::class, 'tachesDuJour']);

    // 🧍 Agent : marquer une réservation comme terminée
    Route::post('/agent/reservations/{id}/terminer', [ReservationController::class, 'terminer']);
});

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');







// Route::prefix('auth')->group(function () {
//     // Inscription
//     Route::post('/register', [AuthController::class, 'register']);

//     // Connexion
//     Route::post('/login', [AuthController::class, 'login']);
    
//     // Routes protégées par Sanctum (utilisateur connecté)
//     Route::middleware('auth:sanctum')->group(function () {
//         // Déconnexion
//         Route::post('/logout', [AuthController::class, 'logout']);

//         // Récupérer les infos de l'utilisateur connecté
//         Route::get('/me', function (Request $request) {
//             return response()->json($request->user());
//         });
//     });
// });

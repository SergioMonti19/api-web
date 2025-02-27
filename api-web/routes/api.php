<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\ApiController;

// Ruta para registro de usuario
Route::post('/register', function (Request $request) {
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    return response()->json(['message' => 'Usuario registrado']);
});

// Ruta para login (autenticación)
Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'No autorizado'], 401);
    }
    return response()->json(['token' => $user->createToken('api-token')->plainTextToken]);
});

// Ruta protegida (requiere autenticación)
Route::middleware('auth:sanctum')->get('/data', function (Request $request) {
    return response()->json(['message' => 'Acceso autorizado']);
});

// Ruta para el mensaje de éxito
Route::get('success', [ApiController::class, 'getSuccessMessage']);

// Ruta para obtener datos de ejemplo
Route::get('data', [ApiController::class, 'getData']);

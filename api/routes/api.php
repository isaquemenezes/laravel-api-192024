<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/Contact', function (Request $request) {
//     return $request->Contact();
// });
Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});
Route::get('contacts/search', [ContactController::class, 'searchByEmailNome']);
Route::apiResource('contacts', ContactController::class);


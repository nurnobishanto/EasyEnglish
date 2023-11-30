<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);
Route::get('/blogs', [AuthController::class, 'blogs']);
Route::get('/books', [AuthController::class, 'books']);
Route::get('/subjects', [AuthController::class, 'subjects']);
Route::get('/subject/{id}', [AuthController::class, 'subject']);
Route::get('/exam/{id}', [AuthController::class, 'exam']);
Route::get('/generate-pdf-question/{id}', [AuthController::class, 'generatePDFquestion']);

Route::get('/migrate', function (){
    \Illuminate\Support\Facades\Artisan::call('migrate');
    return \Illuminate\Support\Facades\Artisan::output();
});


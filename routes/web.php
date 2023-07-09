<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
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

// Route::get('/dashboard', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [HomeController::class, 'dashboard']);
Route::get('/recentmessage', [HomeController::class, 'recentmessage']);
Route::get('/chathistory', [HomeController::class, 'chathistory']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/kirim_pesan', [ChatController::class, 'kirim_pesan']);
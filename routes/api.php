<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;

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
// Route::get('/dashboard', [HomeController::class, 'dashboard']);
Route::get('/recentmessage', [HomeController::class, 'recentmessage']);
Route::get('/chathistory', [HomeController::class, 'chathistory']);

Route::post('/update_profile_img', [HomeController::class, 'update_profile_img']);
Route::post('/kirim_pesan', [ChatController::class, 'kirim_pesan']);
Route::post('/kirim_file', [ChatController::class, 'kirim_file']);
Route::post('/new_chat', [ChatController::class, 'new_chat']);
Route::post('/hapus_pesan', [ChatController::class, 'hapus_pesan']);

// Route::get('/logout', [AuthController::class, 'logout']);

// Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'signup']);
// Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
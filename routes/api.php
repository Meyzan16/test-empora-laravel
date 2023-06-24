<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;

// use App\Http\Middleware\UserAccess;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('books', [BookController::class, 'index']);
// Route::post('books/store', [BookController::class, 'store']);

Route::middleware('user-access')->group(function() {
    
    // Route::prefix('admin')->group(function() {
    // });
 
});

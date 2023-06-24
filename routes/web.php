<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AkunController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Session;


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
// ['middleware' => 'user-access']
Route::group(['middleware' => 'user-access'], function() {
    
    Route::group(['middleware' => 'role-access','prefix'  => 'admin/',],function(){
        Route::get('/',[DashboardController::class, 'index'])->name('dashboard-admin');
        Route::get('akun', function() {return view('Admin.main.akun');})->name('akun');
        Route::resource('akunAjax', AkunController::class);   

        });

        Route::group(['prefix'  => 'user/'],function(){
            Route::get('/',[DashboardController::class, 'index'])->name('dashboard-user');
        });
       
    }
);

Route::get('/403', [ErrorController::class, 'index'] )->name('error-403');

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/authentication', [AuthController::class, 'authentication'] )->name('auth');
Route::POST('/logout', [AuthController::class, 'logout'] )->name('logout');

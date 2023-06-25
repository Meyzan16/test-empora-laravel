<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\ListPeminjamanController;

use App\Http\Controllers\User\PeminjamanController;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
    
        Route::group(['middleware' => 'role-admin','prefix'  => 'admin/',],function(){
            Route::get('/',[DashboardController::class, 'index'])->name('dashboard-admin');
            Route::group(['prefix'  => 'master/'],function(){
                Route::get('akun', function() {return view('Admin.main.akun');})->name('akun');
                Route::get('books', function() {return view('Admin.main.books');})->name('books');
            });



            Route::get('list-pengajuan',[ListPeminjamanController::class, 'index'])->name('list-pengajuan-admin');
            Route::get('list-peminjaman',[ListPeminjamanController::class, 'listpeminjaman'])->name('list-peminjaman-admin');

            Route::patch('{id}/pengajuan_diterima', [ListPeminjamanController::class, 'verifikasi_pengajuan'])->name('verif_pengajuan_diterima');
            Route::patch('{id}/pengajuan_ditolak', [ListPeminjamanController::class, 'verifikasi_pengajuan_tolak'])->name('verif_pengajuan_ditolak');
            Route::patch('{id}/pengembalian_diterima', [ListPeminjamanController::class, 'verifikasi_pengembalian'])->name('verif_pengembalian_diterima');

        });

        Route::group(['middleware' => 'role-user','prefix'  => 'user/'],function(){
            Route::get('/',[DashboardController::class, 'index'])->name('dashboard-user');  
            Route::get('pengajuan-peminjaman',[PeminjamanController::class, 'index'])->name('pengajuan');
            Route::post('peminjaman',[PeminjamanController::class, 'pengajuan'])->name('save-piminjaman');
            Route::delete('delete-peminjaman',[PeminjamanController::class, 'destroy'])->name('delete-peminjaman');
        });
       
    }
);

Route::get('/403', [ErrorController::class, 'index'] )->name('error-403');

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/authentication', [AuthController::class, 'authentication'] )->name('auth')->middleware('guest');
Route::POST('/logout', [AuthController::class, 'logout'] )->name('logout');

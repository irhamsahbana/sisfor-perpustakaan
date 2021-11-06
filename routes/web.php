<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/manajemen-mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.content');
Route::post('/manajemen-mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::put('/manajemen-mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/manajemen-mahasiswa/delete/{id}', [MahasiswaController::class, 'delete'])->name('mahasiswa.delete');

Route::get('/manajemen-buku', [BukuController::class, 'index'])->name('buku.content');
Route::post('/manajemen-buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::put('/manajemen-buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::delete('/manajemen-buku/delete/{id}', [BukuController::class, 'delete'])->name('buku.delete');

Route::get('/manajemen-transaksi', [TransaksiController::class, 'index'])->name('transaksi.content');
Route::post('/manajemen-transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::put('/manajemen-transaksi/update/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::delete('/manajemen-transaksi/delete/{id}', [TransaksiController::class, 'delete'])->name('transaksi.delete');

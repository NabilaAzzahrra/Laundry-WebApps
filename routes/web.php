<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('master', MasterController::class)->middleware(['auth', 'verified']);
Route::resource('transaksi', TransaksiController::class)->middleware(['auth', 'verified']);
Route::resource('member', MemberController::class)->middleware(['auth']);
Route::resource('outlet', OutletController::class)->middleware(['auth']);
Route::resource('paket', PaketController::class)->middleware(['auth']);
Route::resource('laporan', LaporanController::class)->middleware(['auth']);
Route::get('/transaksi/print/{id}', [TransaksiController::class, 'print'])
    ->name('transaksi.print')
    ->middleware(['auth']);

Route::get('/laporan/getLaporan', [TransaksiController::class, 'getLaporan'])
    ->name('laporan.getLaporan')
    ->middleware(['auth']);

Route::get('/transaksi/bayar/{id}', [TransaksiController::class, 'bayar'])
    ->name('transaksi.bayar')
    ->middleware(['auth']);

Route::patch('/transaksi/proses/{id}', [TransaksiController::class, 'proses'])
    ->name('transaksi.proses')
    ->middleware('auth');

Route::patch('/transaksi/selesai/{id}', [TransaksiController::class, 'selesai'])
    ->name('transaksi.selesai')
    ->middleware('auth');

Route::patch('/transaksi/diambil/{id}', [TransaksiController::class, 'diambil'])
    ->name('transaksi.diambil')
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

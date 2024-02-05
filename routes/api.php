<?php

use App\Http\Controllers\API\MemberAPIController;
use App\Http\Controllers\API\OutletAPIController;
use App\Http\Controllers\API\PaketAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/member', [MemberAPIController::class, 'get_all'])->name('tb_member.get');
Route::get('/outlet', [OutletAPIController::class, 'get_all'])->name('tb_outlet.get');
Route::get('/paket', [PaketAPIController::class, 'get_all'])->name('tb_paket.get');
Route::get('/paket/jenis/{jenis}', [PaketAPIController::class, 'get_jenis'])->name('tb_paket.get_jenis');
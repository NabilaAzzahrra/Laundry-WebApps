<?php

use App\Http\Controllers\API\DetailAPIController;
use App\Http\Controllers\API\MemberAPIController;
use App\Http\Controllers\API\OutletAPIController;
use App\Http\Controllers\API\PaketAPIController;
use App\Http\Controllers\API\TransaksiAPIController;
use App\Models\Transaksi;
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
// Route::get('/transaksi', function () {
//     $transaksi = Transaksi::with(
//         'detailtransaksi',
//         'detailtransaksi.paket',
//         'karyawan'
//     )->get();

//     $transaksi->transform(function ($item) {
//         $item->karyawan_name = $item->karyawan->name;
//         unset($item->karyawan); 
//         return $item;
//     });

//     return response()->json($transaksi);
// });
Route::get('/transaksi', [TransaksiAPIController::class, 'get_all']);
Route::get('/detail', [DetailAPIController::class, 'get_all'])->name('tb_detail_transaksi.get');
Route::get('/paket/jenis/{id}', [PaketAPIController::class, 'get_jenis'])->name('tb_paket.get_jenis');

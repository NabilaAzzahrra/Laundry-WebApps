<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiAPIController extends Controller
{
    public function get_all()
    {
        $transaksiQuery = Transaksi::query();

        $tgl_awal = request('tgl_awal', 'all');
        $tgl_akhir = request('tgl_akhir', 'all');

        if ($tgl_awal !== 'all' && $tgl_akhir !== 'all') {
            $transaksiQuery->whereBetween('tgl', [$tgl_awal, $tgl_akhir]);
        }

        $transaksi = $transaksiQuery
        ->with(['detailtransaksi', 'detailtransaksi.paket'])
        ->orderByDesc('tgl')
        ->get();

        // $transaksi = Transaksi::with('detailtransaksi', 'detailtransaksi.paket')->get();
        $transaksi->transform(function ($item) {
            $item->member_name = $item->member->nama;
            $item->karyawan_name = $item->karyawan->name;
            unset($item->karyawan);
            unset($item->member);
            return $item;
        });
        // dd($transaksi);
        return response()->json([
            'transaksi' => $transaksi,
        ]);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiAPIController extends Controller
{
    public function get_all()
    {
        $transaksi = Transaksi::all();
        return response()->json([
            'transaksi'=>$transaksi,
        ]);
    }
}

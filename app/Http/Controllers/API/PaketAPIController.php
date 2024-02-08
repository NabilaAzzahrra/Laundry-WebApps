<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketAPIController extends Controller
{
    public function get_all()
    {
        $paket = Paket::with(['outlet'])->get();
        return response()->json([
            'paket'=>$paket,
        ]);
    }

    public function get_jenis($jenis)
    {
        $paket = Paket::where('id', $jenis)->first();
        return response()->json($paket);
    }
}

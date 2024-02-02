<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketAPIController extends Controller
{
    public function get_all()
    {
        $paket = Paket::all();
        return response()->json([
            'paket'=>$paket,
        ]);
    }
}

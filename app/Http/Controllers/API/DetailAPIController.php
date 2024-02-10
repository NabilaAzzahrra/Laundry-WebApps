<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use Illuminate\Http\Request;

class DetailAPIController extends Controller
{
    public function get_all()
    {
        $detail = Detail::with(['pakets'])->get();
        return response()->json([
            'detail' => $detail,
        ]);
    }
}

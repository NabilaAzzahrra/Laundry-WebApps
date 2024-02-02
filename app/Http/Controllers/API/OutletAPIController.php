<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletAPIController extends Controller
{
    public function get_all()
    {
        $outlet = Outlet::all();
        return response()->json([
            'outlet'=>$outlet,
        ]);
    }
}

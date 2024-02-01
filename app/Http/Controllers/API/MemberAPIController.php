<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberAPIController extends Controller
{
    public function get_all()
    {
        $member = Member::all();
        return response()->json([
            'member'=>$member,
        ]);
    }
}

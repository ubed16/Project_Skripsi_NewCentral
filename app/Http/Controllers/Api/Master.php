<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master as M;

class Master extends Controller
{
    public function getMaster(Request $r)
    {
        $Product = M::find($r->id);
        return response()->json([
            'product' => $Product,
            'msg' => 'success'
        ]);
    }
}

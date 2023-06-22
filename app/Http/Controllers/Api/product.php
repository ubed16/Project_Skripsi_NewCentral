<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Master;
class product extends Controller
{
    public function getProduct(Request $r)
    {
        $Product = Item::find($r->id);
        return response()->json([
            'product' => $Product,
            'msg' => 'success'
        ]);
    }
}

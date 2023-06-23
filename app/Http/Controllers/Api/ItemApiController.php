<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemApiController extends Controller
{
    public function getItem(Request $r)
    {
        $item = Item::find($r->id);
        return response()->json([
            'item' => $item,
            'msg' => 'success'
        ]);
    }
}

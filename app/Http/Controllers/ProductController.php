<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Item;
// use App\Models\Order;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('Admin.all_product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Item::all();
        return view('Admin.add_product', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Item::where('id', $request->code)->first();

        $data = new Product;
        $data->product_code = $item->product_code;
        $data->size = $request->master_size;
        $data->category = $request->master_category;
        $data->stock = $request->Jumlah;
        $data->harga = $request->sub_total;
        $data->tgl = $request->tgl;
        $data->save();

        // $item = Item::where('id',$request->code)->first();
        $item->quantity = $item->quantity + $request->Jumlah;
        $item->save();
        return Redirect()->back()->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $item = Item::all();

        return view('Admin.edit_product', compact(['product', 'item']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products = Product::find($id);
        $productOld = Product::find($id);
        $item = Item::where('id', $request->code)->first();
        $tempStock = Product::where('product_code', $products->product_code)->sum('stock');

        $products->product_code = $item->product_code;
        $products->size = $request->master_size;
        $products->category = $request->master_category;
        $products->stock = $request->Jumlah;
        $products->harga = $request->sub_total;
        $products->tgl = $request->tgl;
        $products->save();


        if ($productOld->product_code == $products->product_code) {
            $sumIN = Product::where('product_code', $products->product_code)->sum('stock');
            $item->quantity = $item->quantity - $tempStock + $sumIN;
        } else {
            $item->quantity = $item->quantity + $products->stock;
            $item->save();
            $item = Item::where('product_code',$productOld->product_code)->first();
            $item->quantity = $item->quantity - $productOld->stock;
        }


        $item->save();

        if ($products) {
            return redirect()->back()->with('success', 'Data Berhasil Di Ubah');
        } else {
            return redirect()->back()->with('data gagal disimpan ', ' Silahkan coba lagi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $item = Item::where('product_code', $product->product_code)->first();
        $item->quantity = $item->quantity - $product->stock;
        $item->save();

        $product->delete();
        return redirect()->route('all.product')->with('success', 'Data Berhasil Terhapus');
    }
}

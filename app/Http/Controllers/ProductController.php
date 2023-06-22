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
    	return view('Admin.all_product',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Item::all();
        return view('Admin.add_product',compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=new Product;
        $data->product_code=$request->code;
    	$data->name= $request->name;
        $data->category = $request->category;
    	$data->stock = $request->stock;
    	$data->harga = $request->harga;
        $data->tgl = $request->tgl;
        $data->save();

        $item = Item::where('product_code',$request->code)->first();
        $item->quantity = $item->quantity + $request->stock;
        $item->save();
        return Redirect()->route('add.product')->with('success', 'Data Berhasil Di Simpan');
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

        return view('Admin.edit_product',compact('product'));
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
        $tempStock = Product::where('product_code',$products->product_code)->sum('stock');
            // dd($products->stock);
            // dd($request->jumlah);
            $products->name= $request->name;
            $products->category = $request->Jenis;
    	    $products->stock = $request->jumlah;
            $products->save();

            // $sumIN = Product::sum('stock');
            // $sumOUT = Order::sum('quantity');
            $sumIN = Product::where('product_code',$products->product_code)->sum('stock');
            // $sumOUT Order::sum('quantity');
            $item = Item::where('product_code',$products->product_code)->first();
            // $item->quantity = $sumIN - $sumOUT;
            $item->quantity = $item->quantity - $tempStock + $sumIN;
            $item->save();

            if($products){
                return redirect()->back()->with('success', 'Data Berhasil Di Ubah');
            }else{
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

        $product->delete();
        return redirect()->route('all.product')->with('success', 'Data Berhasil Terhapus');
    }
}

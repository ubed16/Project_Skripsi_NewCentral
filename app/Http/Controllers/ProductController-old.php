<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Item;
use App\Models\Master;

class ProductController extends Controller
{
    // public function __construct(){
    // 	$this->middleware('auth');
    // }

    public function store(Request $request){

    	$data=new Product;
        $data->product_code=$request->code;
    	$data->name= $request->name;
        $data->category = $request->category;
    	$data->stock = $request->stock;
    	$data->harga = $request->harga;
        $data->tgl = $request->tgl;


        $data->save();

        // $item = Item::where('product_code',$request->code)->first();
        // if (is_null($item)) {
        //     $item = new Item();
        //     $item->product_code = $request->code;
        //     $item->size = $request->name;
        //     $item->quantity = $request->stock;
        //     $item->type = $request->category;

        //     $item->save();
        // } else {
        //     $item->quantity = $item->quantity + $request->stock;

        //     $item->save();
        // }
        return Redirect()->route('add.product')->with('success', 'Data Berhasil Di Simpan');


        // Data Master Barang
        // $master = new Master();
        // $master->master_code = $request->code;
        // $master->master_size = $request->size;
        // $master->master_category = $request->category;
        // $master->master_price = $request->harga;

        // $master->save();
    }

    // public function createItem(Request $request){

    //     $master= Master::where('master_code',$request->code)->first();
    //     if (is_null($master)) {
    //     // Data Master Barang
    //     $master = new Master();
    //     $master->master_code = $request->code;
    //     $master->master_size = $request->size;
    //     $master->master_category = $request->category;
    //     $master->master_price = $request->harga;

    //     $master->save();
    // } else {
    //      $master->quantity = $master->quantity + $request->code;

    //      $master->save();
    //  }

    //         $item = new Item();
    //         $item->product_code = $request->code;
    //         $item->size = $request->name;
    //         $item->type = $request->category;
    //         $item->save();

    //  return Redirect()->route('add.product')->with('success', 'Data Berhasil Di Simpan');
    // }


    public function formatTanggal($tgl){
       // ubah string menjadi format tanggal
        return date('d-m-Y', strtotime($tgl));

    }

    public function allProduct(){
        // $sum = Product::groupBy('product_code')->selectRaw('product_code, sum(stock) as total')->get();
        // dd($sum);
    	$products = Product::all();
    	return view('Admin.all_product',compact('products'));
    }

    // public function allitem(){
    //     // $sum = Product::groupBy('product_code')->selectRaw('product_code, sum(stock) as total')->get();
    //     // dd($sum);
    // 	$item = Item::all();
    // 	return view('Admin.all_item',compact('item'));
    // }

    // public function allmaster(){
    //     // $sum = Product::groupBy('product_code')->selectRaw('product_code, sum(stock) as total')->get();
    //     // dd($sum);
    // 	$master = Master::all();
    // 	return view('Admin.all_master',compact('master'));
    // }

    // public function availableProducts(){
    //     $products = Product::where('stock','>','0')->get();
    //     return view('Admin.available_products',compact('products'));
    // }

    // public function formData(){
    //     $master = Master::all();

    //     // dd($master);

    //     return view('Admin.add_product',compact('master'));
    //     // return view('Admin.add_order',['product'=>$product]);
    // }

    public function editData(Request $request, $id){
        $product = Product::find($id);

        return view('Admin.edit_product',compact('product'));
    }

    public function update(Request $request, $id)
    {

            $products = Product::find($id);
            // dd($products->stock);
            // dd($request->jumlah);
            $products->name= $request->name;
            $products->category = $request->Jenis;
    	    $products->stock = $request->jumlah;
            $products->save();

            $sumIN = Product::sum('stock');
            $sumOUT = Order::sum('quantity');
            // $sumOUT Order::sum('quantity');
            $item = Item::where('product_code',$products->product_code)->first();
            $item->quantity = $sumIN - $sumOUT;
            $item->save();

            if($products){
                return redirect()->back()->with('success', 'Data Berhasil Di Ubah');
            }else{
                return redirect()->back()->with('data gagal disimpan ', ' Silahkan coba lagi');
            }
            // return redirect()->back();
    }

    public function purchaseData($id){
        $product = Product::find($id);

        return view('Admin.purchase_products',compact('product'));
    }

    public function storePurchase(Request $request){

        Product::where('name',$request->name)->update(['stock' => $request->stock + $request->purchase]);

        return Redirect()->route('all.product');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        $product->delete();
        return redirect()->route('all.product')->with('success', 'Data Berhasil Terhapus');
    }

}

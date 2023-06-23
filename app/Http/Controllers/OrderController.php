<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;
use App\Models\Customer;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('Admin.all_orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::where('quantity', '>', 0)->get();
        $customers = Customer::all();
        return view('Admin.new_order', compact('items', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Item::find($request->code);
        $customer = Customer::find($request->id_customer);

        $data = new Order();
        $data->email = $customer->email;
        $data->product_code = $item->product_code;
        $data->product_name = $request->size;
        $data->quantity = $request->quantity;
        $data->order_status = 0;
        $data->customer_name = $customer->company;
        $data->date = $request->tgl;
        $data->save();

        //customer_track
        // $customer = Customer::where('email', '=', $request->email)->first();
        // if($customer === null){
        //     $data3=new Customer;
        //     $data3->name= $request->name;
        //     $data3->email= $request->email;
        //     $data3->company = $request->company;
        //     $data3->address = $request->address;
        //     $data3->phone = $request->phone;
        //     $data3->save();
        // }

        $item = Item::where('id', $request->code)->first();
        $item->quantity = $item->quantity - $request->quantity;
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
        $order = Order::find($id);
        $items = Item::where('quantity', '>', 0)->get();
        $customers = Customer::all();
        return view('Admin.edit_order', compact(['order', 'items', 'customers']));
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
        $order = Order::find($id);
        $orderOld = Order::find($id);
        $customer = Customer::find($request->id_customer);
        $item = Item::where('id', $request->item_code)->first();
        $tempStock = Order::where('product_code', $order->product_code)->sum('quantity');

        $order->email = $customer->email;
        $order->product_code = $item->product_code;
        $order->product_name = $request->size;
        $order->quantity = $request->quantity;
        $order->order_status = 0;
        $order->customer_name = $customer->company;
        $order->date = $request->tgl;
        $order->save();

        if ($orderOld->product_code == $order->product_code) {
            $sumOut = Order::where('product_code', $order->product_code)->sum('quantity');
            $item->quantity = $item->quantity + $tempStock - $sumOut;
        } else {
            $item->quantity = $item->quantity - $order->quantity;
            $item->save();
            $item = Item::where('product_code', $orderOld->product_code)->first();
            $item->quantity = $item->quantity + $orderOld->quantity;
        }

        // $products = Product::find($id);
        // $productOld = Product::find($id);
        // $item = Item::where('id', $request->code)->first();
        // $tempStock = Product::where('product_code', $products->product_code)->sum('stock');

        // $products->product_code = $item->product_code;
        // $products->size = $request->master_size;
        // $products->category = $request->master_category;
        // $products->stock = $request->Jumlah;
        // $products->harga = $request->sub_total;
        // $products->tgl = $request->tgl;
        // $products->save();


        // if ($productOld->product_code == $products->product_code) {
        //     $sumIN = Product::where('product_code', $products->product_code)->sum('stock');
        //     $item->quantity = $item->quantity - $tempStock + $sumIN;
        // } else {
        //     $item->quantity = $item->quantity + $products->stock;
        //     $item->save();
        //     $item = Item::where('product_code',$productOld->product_code)->first();
        //     $item->quantity = $item->quantity - $productOld->stock;
        // }


        $item->save();

        if ($order) {
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
        //
    }
}

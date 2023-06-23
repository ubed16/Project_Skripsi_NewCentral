<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Master;

class OrderController extends Controller
{
    public function store(Request $request){

    	$data=new Order;
    	$data->email= $request->email;
        $data->product_code = $request->code;
        $data->product_name = $request->name;
        $data->quantity = $request->quantity;
    	$data->customer_name = $request->company;
        $data->save();
        return Redirect()->route('all.orders');

    }
     public function newStore(Request $request){

        // dd($request->size);
        $data=new Order;
        $data->email= $request->email;
        $data->product_code = $request->code;
        $data->product_name = $request->size;
        $data->quantity = $request->quantity;
        $data->order_status = 0;
    	$data->customer_name = $request->company;
        $data->save();

        //customer_track
        $customer = Customer::where('email', '=', $request->email)->first();
        if($customer === null){
            $data3=new Customer;
            $data3->name= $request->name;
            $data3->email= $request->email;
            $data3->company = $request->company;
            $data3->address = $request->address;
            $data3->phone = $request->phone;
            $data3->save();
        }

        $item = Item::where('id',$request->code)->first();
        // dd($item);
        $item->quantity = $item->quantity - $request->quantity;

        $item->save();

        return Redirect()->route('all.orders');

    }

    public function newformData(){
        $products = Item::all();
        $customers = Customer::get();
        return view('Admin.new_order',compact('products','customers'));
    }

    public function ordersData(){
        $orders = Order::all();
        return view('Admin.all_orders',compact('orders'));
    }

    public function pendingOrders(){
        $orders = Order::where('order_status','=','0')->get();
        return view('Admin.pending_orders',compact('orders'));
    }

    public function deliveredOrders(){
        $orders = Order::where('order_status','!=','0')->get();
        return view('Admin.delivered_orders',compact('orders'));
    }
}

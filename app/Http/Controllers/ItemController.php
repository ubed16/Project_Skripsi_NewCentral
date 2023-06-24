<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // untuk panggil data master / item
    {
        $item = Item::all();
    	return view('Admin.all_item',compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // untuk menampilkan halaman untuk tambah data master / item
    {
        return view('Admin.all_item');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // untuk menambahkan (post) data item / master
    {
        $item = new Item();
        $item->product_code = $request->code;
        $item->size = $request->name;
        $item->type = $request->category;
        $item->price = $request->price;
        $item->save();

     return redirect()->back()->with('success', 'Data Berhasil Di Simpan');
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
    public function edit($id) // untuk menamplikan halalamn update dan membawa data item yang sudah dicari
    {
        $item = Item::find($id);

        return view('Admin.edit_item', compact($item));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // untuk update data item
    {
        $item = Item::find($id);
        $item->product_code = $request->code;
        $item->size = $request->name;
        $item->type = $request->category;
        $item->price = $request->price;
        $item->save();

        if($item){
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
    public function destroy($id) // untuk menghapus data item
    {
        $item = Item::find($id);
        return redirect()->route('all.item')->with('success', 'Data Berhasil Terhapus');
    }
}

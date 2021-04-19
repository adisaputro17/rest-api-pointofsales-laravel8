<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return Product::all();
    }

    public function show($id){
        return Product::find($id);
    }

    public function store(Request $request){
        return Product::create([
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok')
        ]);
    }

    public function update($id, Request $request){
        $product = Product::find($id);

        $product->nama = is_null($request->nama) ? $product->nama : $request->input('nama');
        $product->harga = is_null($request->harga) ? $product->harga : $request->input('harga');
        $product->stok = is_null($request->stok) ? $product->stok : $request->input('stok');
        $product->save();

        return $product;
    }

    public function delete($id){
        $product = Product::find($id);
        $product->delete();

        return response([
            "message" => "Data berhasil dihapus"
        ]);
    }
}

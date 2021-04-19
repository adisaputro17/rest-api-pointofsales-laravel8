<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request){
        $total_item = 0;
        $total_harga = 0;

        // Menghitung total_item & total_harga di transaksi
        foreach($request->products as $prd){
            $product = Product::find($prd['id']);
            if($prd['total_item'] > $product->stok){
                return response([
                    "message" => 'total item melebihi stok'
                ]);
            }else{
                $product->stok -= $prd['total_item'];
                $product->save();
            }
            $harga = $product->harga * $prd['total_item'];
            $total_harga += $harga;
            $total_item += 1;
        }
        
        $transaksi = new Transaksi();
        $transaksi->total_item = $total_item;
        $transaksi->total_harga = $total_harga;
        $transaksi->save();

        // Menyimpan data ke transaksi_detail
        foreach($request->products as $prd){
            $product = Product::find($prd['id']);
            $harga = $product->harga * $prd['total_item'];

            $detail = [
                'transaksi_id' => $transaksi->id,
                'product_id' => $product->id,
                'total_item' => $prd['total_item'],
                'total_harga' => $harga
            ];
            TransaksiDetail::create($detail);
        }

        return response([
            "message" => 'transaksi berhasil dilakukan',
            "transaksi_id" => $transaksi->id,
            "total_item" => $transaksi->total_item,
            "total_harga" => $transaksi->total_harga
        ]);
    }

    public function index(){
        $transaksis = Transaksi::all();

        foreach($transaksis as $transaksi){
            $details = $transaksi->details;
            foreach($details as $detail){
                $detail->product;
            }
        }

        return $transaksis;
    }

    public function show($id){
        $transaksi = Transaksi::with('details')->get()->find($id);
        foreach($transaksi->details as $detail){
            $detail->product;
        }

        return $transaksi;
    }

    public function delete($id){
        $transaksi = Transaksi::find($id);
        $transaksi->delete();

        return response([
            "message" => "Transaksi berhasil dihapus"
        ]);
    }
}

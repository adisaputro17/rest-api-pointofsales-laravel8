<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_details';
    protected $fillable = ['transaksi_id','product_id','total_item','total_harga'];

    public function transaksi(){
        return $this->belongsTo(Transaksi::class,'transaksi_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}

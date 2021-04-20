<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $fillable = ['user_id','total_item','total_harga'];

    public function details(){
        return $this->hasMany(TransaksiDetail::class,'transaksi_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}

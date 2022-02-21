<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table='pemesanan';
    protected $fillable=['photo_id','produk_id','author','status','namapemesanan','jenispaket','buktipembayaran','alamat','tglfoto','no_telp','id_user'];

    public function paketstudio()
    {
        return $this->hasOne(Paketstudio::class,'id_paketstudio');
    }
}
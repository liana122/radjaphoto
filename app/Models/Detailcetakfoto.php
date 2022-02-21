<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailcetakfoto extends Model
{
    use HasFactory;

    protected $table='detailcetakfoto';
    protected $fillable=['produk_id','id_cetakfoto','author','namapemesan','jumlahpesanan','foto','no_telp','status','buktitransfer','id_user'];
}

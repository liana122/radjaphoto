<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailproduk extends Model
{
    use HasFactory;

    protected $table='detailproduk';
    protected $fillable=['id_produk','author','namapemesan','jumlahpesanan','foto','keterangan','no_telp','status','buktitransfer','id_user'];
}

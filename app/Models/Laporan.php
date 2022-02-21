<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table='laporan';
    protected $fillable=['id_paket','namapemesan','tgltransaksi'];

    public function paketfoto()
    {
        return $this->belongsTo(Paketfoto::class);
    }

    // public function produk()
    // {
    //     return $this->belongsTo(Produk::class);
    // }
}

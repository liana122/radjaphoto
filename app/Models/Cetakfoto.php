<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CetakFoto extends Model
{
    use HasFactory;
    protected $table='cetakfoto';
    protected $fillable=['gambar','harga','keterangan','stok','author'];

    public function paket()
    {
        return $this->belongsTo(Cetakfoto::class, 'produk_id', 'id');
    }
    
}

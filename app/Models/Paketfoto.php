<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paketfoto extends Model
{
    use HasFactory;
    protected $table='paketfoto';
    protected $fillable=['gambar','jenispaket','keterangan','harga','author'];

    public function paket()
    {
        return $this->belongsTo(Paketfoto::class, 'produk_id', 'id');
    }
    
}

<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class galerifoto extends Model
{
    protected $primaryKey = 'id_galeri';
    protected $table = 'galerifoto';
    protected $fillable = ['gambar','author'];
}
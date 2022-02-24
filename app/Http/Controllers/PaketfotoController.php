<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paketfoto;
use App\Models\Laporan;
use App\Models\Pemesanan;
use App\Models\Photo;

class PaketfotoController extends Controller
{
    public function index()
    {
        $data=Photo::orderBy('id','desc')->where('type', 'paketfoto')->get();
        // dd($data);
        return view('paketfoto.index',compact('data'));
    }
    public function tambah()
    {
        return view('paketfoto.tambah');
    }
    public function simpan(Request $req)
    {
        $req->validate([
            'gambar' => 'mimes:png,jpg,jpeg'
        ]);
        $data=new Photo;
        $data->jenispaket=$req->jenispaket;
        $data->keterangan=$req->keterangan;
        $data->harga=$req->harga;
        $data->author=auth()->user()->name;
        $data->type = 'paketfoto';
        if ($req->has('gambar')) {

            $req->file('gambar')->move(public_path() . '/gambar/'.auth()->user()->name , $req->file('gambar')->getClientOriginalName());
            $data->gambar = $req->file('gambar')->getClientOriginalName();
            $data->save();
            // Alert::success('Tersimpan','data berhasil disimpan');
            return redirect('/admin/paketfoto')->with('status','Data berhasil ditambahkan!');
        }
        return redirect('/admin/paketfoto');
        // dd($req->all());
    }

    public function edit($id)
    {
        $data=Photo::find($id);
        return view('paketfoto.edit',compact('data'));
    }
    public function perbarui(Request $req,$id)
    {
        // dd($req->all());
        $data=Photo::find($id);
        $data->jenispaket=$req->jenispaket;
        $data->keterangan=$req->keterangan;
        $data->harga=$req->harga;
        
        if ($req->has('gambar')) {

            $req->file('gambar')->move(public_path() . '/gambar/'.auth()->user()->name , $req->file('gambar')->getClientOriginalName());
            $data->gambar = $req->file('gambar')->getClientOriginalName();
        }
        $data->save();
        // Alert::success('Terupdate','data berhasil diupdate');
        return redirect('/admin/paketfoto')->with('status','Data berhasil diedit!');
        
    }

    public function hapus($id)
    {
        $paketfoto = Photo::find($id);
        $paketfoto->delete();
        return redirect('admin/paketfoto')-> with('status', 'Paket foto berhasil dihapus!');
    }
    
}

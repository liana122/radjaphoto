<?php

namespace App\Http\Controllers;

use App\Models\Detailcetakfoto;
use Illuminate\Http\Request;
use App\Models\Cetakfoto;
use App\Models\Photo;
// use RealRashid\SweetAlert\Facades\Alert;

class CetakfotoController extends Controller
{
    public function index()
    {
        $data=Photo::orderBy('id','desc')->where('type', 'cetakfoto')->get();
        return view('cetakfoto.index',compact('data'));
    }
    public function tambah()
    {
        return view('cetakfoto.tambah');
    }
    public function simpan(Request $req)
    {
        $data= new Photo;
        // $data->nama=$req->nama;
        $data->harga = $req->harga;
        $data->keterangan = $req->keterangan;
        $data->stok = $req->stok;
        $data->author = auth()->user()->name;
        $data->type = 'cetakfoto';
        if ($req->has('gambar')) {

            $req->file('gambar')->move(public_path() . '/gambar/'.auth()->user()->name , $req->file('gambar')->getClientOriginalName());
            $data->gambar = $req->file('gambar')->getClientOriginalName();
            $data->save();
            // Alert::success('Tersimpan','data berhasil disimpan');
            return redirect('/admin/cetakfoto')->with('status','Data berhasil ditambahkan!');
        }
        return redirect('/admin/cetakfoto');
        // dd($req->all());
    }

    public function edit($id)
    {
        $data=Photo::find($id);
        return view('cetakfoto.edit',compact('data'));
    }
    public function perbarui(Request $req,$id)
    {
        // dd($req->all());
        $data=Photo::find($id);
        // $data->nama=$req->nama;
        $data->harga=$req->harga;
        $data->keterangan=$req->keterangan;
        $data->stok=$req->stok;
        
        if ($req->has('gambar')) {

            $req->file('gambar')->move(public_path() . '/gambar/'.auth()->user()->name , $req->file('gambar')->getClientOriginalName());
            $data->gambar = $req->file('gambar')->getClientOriginalName();
        }
        $data->save();
        // Alert::success('Terupdate','data berhasil diupdate');
        return redirect('/admin/cetakfoto')->with('status','Data berhasil diedit!');
        
    }
    // public function hapus($id)
    // {
    //     $data=Produk::find($id)->delete();
    //     return redirect('/admin/cetakfoto')->with('status','Data berhasil dihapus')->back();
    //     // return redirect()->back();
    // }

    // public function hapus($id)
    // {
    //     $data=Produk::find($id);
    //    // $laporan=Laporan::where('id_paket',$id)->delete();
    //     $detailcetakfoto=Detailcetakfoto::where('id_cetakfoto',$id)->delete();
    //     $data->delete();
    //     return redirect()->back();
    // }
    
    public function hapus($id)
    {
        $cetakfoto = Photo::find($id);
        // dd($galeri);
        $cetakfoto->delete();
        return redirect('admin/cetakfoto')-> with('status', 'Produk berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Paketfoto;
use App\Models\Cart;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

// use Illuminate\Support\Facades\Storage;
// use RealRashid\SweetAlert\Facades\Alert;

class PemesananController extends Controller
{
    public function index()
    {
        if(auth()->user()->role=='admin'){
            $data=Pemesanan::orderBy('id','desc')->get();

        }else{

            $data=Pemesanan::where('id_user',auth()->user()->id)->orderBy('id','desc')->get();
        }
        return view('pemesanan.index',compact('data'));
    }
    public function pesan($id)
    {
        $data=Paketfoto::find($id);
        return view('pemesanan.pesan',compact('data'));
    }

    public function simpan(Request $req,$id)
    {

        $data=new Pemesanan;
        $data->produk_id=$id;
        $data->author=auth()->user()->name; 
        $data->id_user=auth()->user()->id;
        $data->namapemesan=$req->namapemesan;
        $data->jenispaket=$req->jenispaket;
        $data->alamat=$req->alamat;
        $data->tglfoto=$req->tglfoto;
        $data->no_telp=$req->no_telp;
        $data->status='Menunggu Konfirmasi';
        
        if ($req->has('buktipembayaran')) {

            $req->file('buktipembayaran')->move(public_path() . '/buktipembayaran/'.auth()->user()->name , $req->file('buktipembayaran')->getClientOriginalName());
            $data->buktipembayaran = $req->file('buktipembayaran')->getClientOriginalName();
            $data->save();
            // Alert::success('Tersimpan','data berhasil disimpan');
            return redirect('/'.auth()->user()->role.'/pemesanan')->with('status','Data berhasil disimpan!');
        }
        return redirect('/admin/pemesanan');
    }
    
    public function simpanCart(Request $req,$id)
    {
        $produkIds = $req->get('produk_ids');
        $randomStr = Str::random(10);

        if ($req->has('buktipembayaran')) {
            $req->file('buktipembayaran')->move(public_path() . '/buktipembayaran/'.auth()->user()->name , $randomStr.'.'.$req->file
            ('buktipembayaran')->getClientOriginalExtension());
        }

        foreach (explode("-", $produkIds) as $produkId) {
            $data=new Pemesanan;
            $data->photo_id     = $produkId;
            $data->author = auth()->user()->name;
            $data->id_user = auth()->user()->id;
            $data->namapemesan = $req->namapemesan;
            $data->jenispaket = $req->jenispaket;
            $data->alamat = $req->alamat;
            $data->tglfoto = $req->tglfoto;
            $data->no_telp = $req->no_telp;
            $data->status = 'Menunggu Konfirmasi';
            $data->buktipembayaran = $randomStr.'.'.$req->file('buktipembayaran')->getClientOriginalExtension();
        }

        $deleteCart = Cart::where("user_id",$id)->delete();
        Alert::success('Tersimpan','Pesanan Berhasil dibuat');
        return redirect('/'.auth()->user()->role.'/pemesanan');
    }

    public function update($id,Request $request)
    {
        $data=Pemesanan::find($id);
        if($request->status=='Selesai'){
            $paketfoto=Paketfoto::find($data->produk_id);
                $data->status='Selesai';
        }
        $data->status = $request->status;
        $data->update();
        // Alert::success('Terupdate','data berhasil diupdate');
        return redirect()->back()->with('status','Data berhasil diubah!');
    }


    public function destroy($id)
    {
        $data=Pemesanan::find($id)->delete();
        return redirect()->back()->with('status','Data Berhasil dihapus!');
    }
    
    // public function delete($id)
    // {
    //     // $delete = DB::table('pemesanan')->where('id',$id)->delete();
    //     $delete = Pemesanan::findOrFail($id);
    //     Storage::delete($delete);
    //     $delete->delete();
    //     return redirect('admin/pemesanan')-> with('status', 'Data berhasil dihapus!');
    // }
}
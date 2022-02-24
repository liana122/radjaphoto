<?php

namespace App\Http\Controllers;

use App\Models\Detailcetakfoto;
use Illuminate\Http\Request;
use App\Models\CetakFoto;
use App\Models\Photo;
use App\Models\Laporan;
use App\Models\Pemesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetailcetakfotoController extends Controller
{
    public function index()
    {
        // if(auth()->user()->role=='admin'){
        //     $data=Detailcetakfoto::addSelect('detailcetakfoto.id as detail_id', 'carts.*', 'carts.produk_id as carts_produk_id', 'detailcetakfoto.*','detailcetakfoto.author as author_user','photo.*','photo.keterangan as produk')
        //     //->leftJoin('cetakfoto', 'cetakfoto.id', '=', 'detailcetakfoto.id_cetakfoto')
        //     ->leftJoin('carts', 'carts.produk_id', '=', 'detailcetakfoto.id_cetakfoto')
        //     ->leftJoin('photo', 'photo.id', '=', 'detailcetakfoto.id_cetakfoto')
        //     ->orderBy('photo.id','desc')->get();

        //     // dd($da)
        // }else{
        //     $data = Detailcetakfoto::where('id_user',auth()
        //             ->user()->id)
        //             ->addSelect('detailcetakfoto.id as detail_id', 'carts.*', 'carts.produk_id as carts_produk_id', 'detailcetakfoto.*','detailcetakfoto.author as author_user','photo.*','photo.keterangan as produk')
        //             //->leftJoin('cetakfoto', 'cetakfoto.id', '=', 'detailcetakfoto.id_cetakfoto')
        //             ->leftJoin('carts', 'carts.produk_id', '=', 'detailcetakfoto.id_cetakfoto')
        //             ->leftJoin('photo', 'photo.id', '=', 'detailcetakfoto.id_cetakfoto')
        //             ->orderBy('photo.id','desc')->get();
        // }

        if (auth()->user()->role=='admin'){
           $data = Detailcetakfoto::all();
        }else{
           $data = Detailcetakfoto::where('id_user', Auth::user()->id)->get();
        }
        // dd($data);
    //    $data = Detailcetakfoto::where('id_user', auth()->id())->get();
       return view('Detailcetakfoto.index',compact('data'));
    }
    
    public function pesan($id)
    {
        $data=Photo::find($id);
        return view('Detailcetakfoto.pesan',compact('data'));
    }

    public function simpan(Request $req, $id)
    {
        /*$data= new Detailcetakfoto;
        $data->id_cetakfoto = $req->produk_id;
        $data->author = auth()->user()->name;
        $data->namapemesan = $req->namapemesan;
        $data->jumlahpesanan = $req->jumlahpesanan;
        $data->no_telp= $req->no_telp;
        $data->id_user = auth()->user()->id;
        $data->status = 'Menunggu Konfirmasi';*/
        DB::beginTransaction();
        try {
            //code...
            if ($req->type_produk == 'paketfoto') {
                $data = new Pemesanan;
                $data->photo_id= $req->produk_id;
                $data->author = auth()->user()->name; 
                $data->id_user = auth()->user()->id;
                $data->namapemesan = $req->namapemesan;
                $data->jenispaket = $req->jenispaket;
                $data->alamat= $req->alamat;
                $data->tglfoto = $req->tglfoto;
                $data->no_telp=$req->no_telp;
                $data->status='Menunggu Konfirmasi';
                $data->save();
                
                if ($req->has('buktitransfer')) {
        
                    $req->file('buktitransfer')->move(public_path() . '/buktipembayaran/'.auth()->user()->name , $req->file('buktitransfer')->getClientOriginalName());
                    $data->buktipembayaran = $req->file('buktitransfer')->getClientOriginalName();
                    $data->save();
                    // Alert::success('Tersimpan','data berhasil disimpan');
                    return redirect('/'.auth()->user()->role.'/pemesanan')->with('status','Data berhasil disimpan!');
                }
            } else {
                if ($req->has('buktitransfer')) {
                    // dd($req->file('buktitransfer'), $req->file('foto'));
        
                    $req->file('buktitransfer')->move(public_path() . '/buktitransfer/'.auth()->user()->name , $req->file('buktitransfer')->getClientOriginalName());
                    //$data->buktitransfer = $req->file('buktitransfer')->getClientOriginalName();
                    
                    $fileName = [];
                    foreach($req->file('foto') as $foto) { 
                    // dd($foto);
                        //createDirectory(Carbon::now());
                        $foto->move(public_path() , '/foto/'.auth()->user()->name , $foto->getClientOriginalName());
                        $fileName[] .=  $foto->getClientOriginalName();
                    }
        
                    $dataArray = [
                        'id_cetakfoto' => $req->produk_id,
                        'author' => auth()->user()->name,
                        'namapemesan' => $req->namapemesan,
                        'buktitransfer' => $req->file('buktitransfer')->getClientOriginalName(),
                        'jumlahpesanan' => $req->jumlahpesanan,
                        'no_telp' => $req->no_telp,
                        'id_user' => auth()->user()->id,
                        'status' => 'Menunggu Konfirmasi',
                        'foto' => implode(",", $fileName),
                    ];
                    //dd($dataArray);
                    $result = Detailcetakfoto::create($dataArray);
                    //dd($result);
                    //$data->foto = implode(",", $fileName);    
                    //$data->save();
                }
                 return redirect('user/detailcetakfoto')->with('status','Data berhasil ditambahkan');
            }
            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
        
    }

    public function update($id,Request $request)
    {
        $data=Detailcetakfoto::findorFail($id);
        //return $id;
        if($request->status=='Selesai'){
            $cetakfoto=Photo::find($data->id_cetakfoto);
            $perhitungan = $cetakfoto->stok - $data->jumlahpesanan;
            if($perhitungan>=0){
                $cetakfoto->update(['stok'=>$perhitungan]);
                $data->update([
                    'status'=>'selesai'
                ]);
                return redirect()->back()->with('status','Data berhasil diubah');
            }else{
                return redirect()->back()->with('status','Stok anda tidak cukup');
            }
        }
        
        $data->update($request->all());
        return redirect()->back()->with('status','Data berhasil diubah');
    }

    public function destroy($id)
    {
        // dd($id);
        $data = Detailcetakfoto::findOrFail($id);
        $data->delete();
        // Detailcetakfoto::destroy($id);
        return redirect()->back()->with('status','Data berhasil dihapus');
    }

    public function admindestroy($id)
    {
        // dd($id);
        $data = Detailcetakfoto::findOrFail($id);
        $data->delete();
        // Detailcetakfoto::destroy($id);
        return redirect()->back()->with('status','Data berhasil dihapus');
    }

}

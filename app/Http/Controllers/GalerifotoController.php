<?php

namespace App\Http\Controllers;

use App\Models\Galerifoto;
use App\Models\User;
use Validator;
use Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;

class GalerifotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $galerifoto = Galerifoto::paginate(10);


        // dd($galery);

        // if (Auth::user()->role == 'users') {
        //     $galeri = Galeri::where("id_galeri", Auth::user()->role)->get();
        // } else  {
        //     $galeri = Galeri::all();

        // }

        return view('galerifoto.index',compact("galerifoto"));
    }

    /**
     * the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah()
    {
        //
        // dd('test');
        // echo("tes");
        return view('galerifoto.tambah');
    }

    /**
     * Store a newly tambah resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpan(Request $request)
    {
        // dd(Auth::user()->name);
        $request -> validate([
            'gambar' => 'required|image|mimes:jpeg,jpg,png,svg|max:2048',
        ]);
        $fileName = "";

        if($request->file('gambar')->isValid()) {
            $gambarFile = $request->file('gambar');
            $extention = $gambarFile->getClientOriginalExtension();
            $fileName = date('YmdHis') . "." . $extention;
            $uploadPath = "gambar/admin";
            $request->file('gambar')->move($uploadPath,$fileName);
        }

        $galerifoto = Galerifoto::create([
            'gambar' => $fileName,
            'author' => Auth::user()->name
        ]);
        // Alert::success('Tersimpan','data berhasil disimpan');
        return redirect('admin/galerifoto')-> with('status', 'Galeri foto berhasil ditambahkan!');
    }

    public function show($id_galeri)
    {
        // ddd($request->id);
        $galerifoto = Galerifoto::find($id_galeri);
        // ddd($galerifoto);
        $array = ['data' => $galerifoto,'id_galeri' => $id_galeri];
        return view('galerifoto/show',$array);

    }

    /**
     * the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_galeri)
    {
        //
        // $user->assignRole('galeri');
        $galerifoto = Galerifoto::find($id_galeri);
        // $galerifoto = galerifoto::all();
        //dd($galerifoto);
        return view("galerifoto/edit", compact('galerifoto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perbarui(Request $request, $id_galeri)
    {
        // dd($request);
        $galerifoto = Galerifoto::findOrFail($id_galeri);
        if($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $n = $file->getClientOriginalName();
            $name = "user $n";
            $file->move(public_path().'/gambar/admin',$name);
            $photo = $name;
        }else{
            $photo = $galerifoto->gambar;
        }
        $galerifoto->gambar = $photo;
        $galerifoto->save();
        // Alert::success('Terupdate','data berhasil diupdate');
        return redirect('/admin/galerifoto')-> with('status', 'Galeri foto berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        $galerifoto = Galerifoto::find($id);
        // dd($galeri);
        $galerifoto->delete();
        return redirect('admin/galerifoto')-> with('status', 'Galeri Foto berhasil dihapus!');
    }
}
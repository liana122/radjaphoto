<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function index()
    {
        $data=Laporan::orderBy('id','desc')->get();
        return view('laporan.index',compact('data'));
    }
    // public function destroy($id)
    // {
    //     Laporan::find($id)->delete();
    //     return redirect()->back()->with('sukses','Data berhasil dihapus');
    // }
}
<?php

namespace App\Http\Controllers;

use App\Models\CetakFoto;
use App\Models\Detailcetakfoto;
use Illuminate\Http\Request;
use App\Models\Laporan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $data=Laporan::orderBy('id','desc')->get();
        return view('laporan.index',compact('data'));
    }

    public function getReportByPelangganID($pelanggan_id)
    {
        $result = Detailcetakfoto::select(DB::raw("detailcetakfoto.id,detailcetakfoto.namapemesan,users.name,users.email,users.role,detailcetakfoto.jumlahpesanan,photo.harga,
                    detailcetakfoto.jumlahpesanan*photo.harga as total, detailcetakfoto.foto,detailcetakfoto.no_telp,detailcetakfoto.status,detailcetakfoto.buktitransfer,
                    detailcetakfoto.author,detailcetakfoto.created_at as tgltransasksi,photo.keterangan,photo.type,photo.jenispaket"))
                    ->join('photo','photo.id','=','detailcetakfoto.id_cetakfoto')
                    ->join('users','users.id','=','detailcetakfoto.id_user')
                    ->where('detailcetakfoto.id_user',$pelanggan_id)
                    ->get();

                    return response()->json($result);
        $params = [
            'results' => $result,
            'title' => 'Laporan Penjualan',
        ];

        $pdf = PDF::loadView('laporan.transaksi-pdf',$params);

        return $pdf->download('laporan-penjualan.pdf');
    }

    public function getReportByPelangganIDWithDateRange($pelanggan_id, $dari_tanggal, $sampai_tanggal)
    {
        $result = Detailcetakfoto::select(DB::raw("detailcetakfoto.id,detailcetakfoto.namapemesan,users.name,users.email,users.role,detailcetakfoto.jumlahpesanan,photo.harga,
                    detailcetakfoto.jumlahpesanan*photo.harga as total, detailcetakfoto.foto,detailcetakfoto.no_telp,detailcetakfoto.status,detailcetakfoto.buktitransfer,
                    detailcetakfoto.author,detailcetakfoto.created_at as tgltransasksi,photo.keterangan,photo.type,photo.jenispaket"))
                    ->join('photo','photo.id','=','detailcetakfoto.id_cetakfoto')
                    ->join('users','users.id','=','detailcetakfoto.id_user')
                    ->where('detailcetakfoto.id_user',$pelanggan_id)
                    ->whereRaw('date_format(detailcetakfoto.created_at,"%Y-%m-%d") >= "'.Carbon::parse($dari_tanggal)->format('Y-m-d').'" and 
                     date_format(detailcetakfoto.created_at,"%Y-%m-%d") <= "'.Carbon::parse($sampai_tanggal)->format('Y-m-d').'"')
                    ->get();

                    //return response()->json($result);
                    //->get();

        $params = [
            'results' => $result,
            'title' => 'Laporan Penjualan',
        ];

        $pdf = PDF::loadView('laporan.transaksi-pdf',$params);

        return $pdf->download('laporan-penjualan.pdf');
    }

    public function getViewFilter()
    {
        return view('laporan.filter-date');
    }

    public function getReportByDateRange(Request $request)
    {
        //nanti kamu tambahin validate rule yaa..
        $result = Detailcetakfoto::select(DB::raw("detailcetakfoto.id,detailcetakfoto.namapemesan,users.name,users.email,users.role,detailcetakfoto.jumlahpesanan,photo.harga,
                    detailcetakfoto.jumlahpesanan*photo.harga as total, detailcetakfoto.foto,detailcetakfoto.no_telp,detailcetakfoto.status,detailcetakfoto.buktitransfer,
                    detailcetakfoto.author,detailcetakfoto.created_at as tgltransasksi,photo.keterangan,photo.type,photo.jenispaket,detailcetakfoto.id_user"))
                    ->join('photo','photo.id','=','detailcetakfoto.id_cetakfoto')
                    ->join('users','users.id','=','detailcetakfoto.id_user')
                    ->whereRaw('date_format(detailcetakfoto.created_at,"%Y-%m-%d") >= "'.Carbon::parse($request->dari_tanggal)->format('Y-m-d').'" and 
                     date_format(detailcetakfoto.created_at,"%Y-%m-%d") <= "'.Carbon::parse($request->sampai_tanggal)->format('Y-m-d').'"')
                    ->get();

        $params = [
            'results' => $result,
            'title' => 'Laporan Penjualan',
        ];

        $pdf = PDF::loadView('laporan.penjualan',$params);

        return $pdf->download('penjualan.pdf');
    }

    public function getPreviewPDF(Request $request)
    {
        //select a.id,a.namapemesan,c.name,c.email,c.role,a.jumlahpesanan,b.harga,a.jumlahpesanan*b.harga as total, a.foto,a.no_telp,a.status,a.buktitransfer,a.author,a.created_at as tgltransasksi,b.keterangan,b.type,b.jenispaket from detailcetakfoto a inner join photo b on a.id_cetakfoto=b.id inner join users c on a.id_user=c.id

        dd($request->pelanggan_id);
        $result = Detailcetakfoto::select(DB::raw('detailcetakfoto.id,detailcetakfoto.namapemesan,users.name,users.email,users.role,detailcetakfoto.jumlahpesanan,photo.harga,
                    detailcetakfoto.jumlahpesanan*photo.harga as total, detailcetakfoto.foto,detailcetakfoto.no_telp,detailcetakfoto.status,detailcetakfoto.buktitransfer,
                    detailcetakfoto.author,detailcetakfoto.created_at as tgltransasksi,photo.keterangan,photo.type,photo.jenispaket'))
                    ->join('photo','photo.id','=','detailcetakfoto.id_cetakfoto')
                    ->join('users','users.id','=','detailcetakfoto.id_user');
                    //->get();

        if($request->pelanggan_id != null){
            $where = $result->when('detailcetakfoto.id_user',$request->pelanggan_id);
        }else{
            if($request->dari_tanggal != null && $request->sampai_tanggal != null){
                $where = $result->when('detailcetakfoto.id_user',$request->pelanggan_id)
                        ->whereDate([
                            ['detailcetakfoto.created_at','>=',$request->dari_tanggal],
                            ['detailcetakfoto.created_at','<=',$request->sampai_tanggal],
                        ]);
            }
        }

        $results = $where->getQuery();

        dd($results);

        $params = [
            'results' => $result,
            'title' => 'Laporan Penjualan',
        ];

        $pdf = PDF::loadView('laporan.transaksi-pdf',$params);

        return $pdf->download('laporan-penjualan.pdf');
    }
    // public function destroy($id)
    // {
    //     Laporan::find($id)->delete();
    //     return redirect()->back()->with('sukses','Data berhasil dihapus');
    // }
}
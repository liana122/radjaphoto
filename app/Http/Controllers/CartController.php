<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
use App\Models\Cart;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Paketfoto;
use App\Models\Photo;
 
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
       // return $req;
            // $data=Cart::where('id_user',auth()->user()->id)->orderBy('id','desc')->get();
            $user = auth()->user()->id;
            $cart = DB::select("SELECT *, carts.id as id FROM carts JOIN photo on carts.produk_id = photo.id WHERE user_id = '$user'");
         //return $cart;  
        
       return view('cart.index',compact('cart'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function addToCart(Request $req)
    {
        
        $data = new Cart;
        // $data->nama=$req->nama;
        $produkId = $req->idProduk;
        $produk = Photo::find($produkId);
        $data->user_id=auth()->user()->id;
        $total = $req->jumlahPesanan ;
        $totalHarga =$produk->harga*$req->jumlahPesanan;
 
        $data->produk_id=$produk->id;
        $data->jumlahPesanan = $req->jumlahPesanan;
        $data->hargaSatuan = $produk->harga;
        $data->totalHarga = $totalHarga;
        $data->save();
        
        Alert::success('Berhasil', 'Paket dimasukkan ke dalam keranjang');
        return redirect('/user/paketfoto')->with('status','Berhasil Menambahkan ke keranjang!');
    }
 
    public function deleteCart($id){
        
        $cart = Cart::find($id);
        // dd($cart);
        $cart->delete();
        Alert::success('Berhasil', 'Keranjang berhasil dihapus dari keranjang');
        return redirect('/user/cart');
 
    }
    public function lanjutkanPemesanan(Request $request){  

        if (empty($request->get('cart_ids'))) {
            Alert::warning('Tidak ada produk dipilih', 'Pilih produk untuk melanjutkan');
            return redirect('/user/cart');
       }

        $validate = count($request->get('cart_ids')) ?? 2;


        if ($validate > 1 && !empty($request->get('cart_ids'))) {
            Alert::warning('Pilih salah satu produk', 'Silahkan pilih  salah satu produk untuk melanjutkan');
            return redirect('/user/cart');
       }


        $userid = auth()->user()->id;
            $cart = DB::table('carts')
                ->join('photo', 'carts.produk_id', '=', 'photo.id')
               // ->leftJoin('detailcetakfoto', 'detailcetakfoto.user_id', '=', 'photo.id')
                ->where('user_id', $userid)
                ->when($request->get('cart_ids'), function ($query, $carts_id) {
                    return $query->whereIn('carts.id', $carts_id);
                })
                ->get();
            $cetakfoto = '';
            $hargaTotal = $cart->sum('totalHarga');
            return view("cart.lanjutan", compact('userid','cart','hargaTotal','cetakfoto'));
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
 
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
<?php
 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\GalerifotoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketfotoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CetakfotoController;
use App\Http\Controllers\DetailcetakfotoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 
Route::get('/', function () {
    return view('auth.login');
});
 
Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/proses_register', [AuthController::class, 'proses_register'])->name('proses_register');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('download', 'DetailcetakfotoController@download');

 
Route::prefix('admin')->middleware('auth', 'role:admin')->group(function () {
 
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.admin');
    Route::get('/paketfoto',[PaketfotoController::class,'index'])->name('paketfoto.admin');
    Route::get('/paketfoto/tambah',[PaketfotoController::class,'tambah'])->name('paketfoto.tambah');
    Route::post('/paketfoto/tambah/simpan',[PaketfotoController::class,'simpan'])->name('paketfoto.simpan');
    Route::post('/paketfoto/edit/{id}/perbarui',[PaketfotoController::class,'perbarui'])->name('paketfoto.perbarui');
    Route::get('/paketfoto/{id}',[PaketfotoController::class,'hapus']);
    Route::get('/paketfoto/edit/{id}',[PaketfotoController::class,'edit']);

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.admin');
    Route::get('/galerifoto',[GalerifotoController::class,'index'])->name('galerifoto.admin');
    Route::get('/galerifoto/tambah',[GalerifotoController::class,'tambah'])->name('galerifoto.tambah');
    Route::post('/galerifoto/tambah/simpan',[GalerifotoController::class,'simpan'])->name('galerifoto.simpan');
    Route::put('/galerifoto/edit/{id}/perbarui',[GalerifotoController::class,'perbarui'])->name('galerifoto.perbarui');
    Route::delete('/galerifoto/{id}',[GalerifotoController::class,'hapus']);
    Route::get('/galerifoto/edit/{id}',[GalerifotoController::class,'edit']);
    Route::get('/galerifoto/{id}', 'App\Http\Controllers\GalerifotoController@show');

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.admin');
    Route::get('/cetakfoto',[CetakfotoController::class,'index'])->name('cetakfoto.admin');
    Route::get('/cetakfoto/tambah',[CetakfotoController::class,'tambah'])->name('cetakfoto.tambah');
    Route::post('/cetakfoto/tambah/simpan',[CetakfotoController::class,'simpan'])->name('cetakfoto.simpan');
    Route::post('/cetakfoto/edit/{id}/perbarui',[CetakfotoController::class,'perbarui'])->name('cetakfoto.perbarui');
    Route::get('/cetakfoto/{id}',[CetakfotoController::class,'hapus']);
    Route::get('/cetakfoto/edit/{id}',[CetakfotoController::class,'edit']);
 
    Route::get('/pemesanan',[PemesananController::class,'index'])->name('pemesanan.admin');
    Route::post('/pemesanan/{id}/update',[PemesananController::class,'update']);
    Route::get('/pemesanan/{id}/delete',[PemesananController::class,'destroy']);
    // Route::delete('/pemesanan/{id}',[PemesananController::class,'delete'])->name('pemesanan.delete');
    Route::get('/detailcetakfoto',[DetailcetakfotoController::class,'index'])->name('detailcetakfoto.admin');
    Route::post('/detailcetakfoto/{id}/update',[DetailcetakfotoController::class,'update'])->name('detailcetakfoto.admin.update');
    Route::delete('/detailcetakfoto/delete/{id}',[DetailcetakfotoController::class,'admindestroy'])->name('detailcetakfoto.admin.destroy');
    Route::get('/laporan',[LaporanController::class,'index']);
    Route::get('/laporan/{id}/delete',[LaporanController::class,'destroy']);
    Route::get('laporan-view',[LaporanController::class,'getPreviewPDF']);
    Route::get('laporan/{pelanggan_id}/preview',[LaporanController::class,'getPreviewPDF']);
    Route::get('laporan/{pelanggan_id}/dari-tanggal/{dari_tanggal}/sampai-tanggal/{sampai_tanggal}',
        [LaporanController::class,'getReportByPelangganIDWithDateRange']);

    Route::get('laporan/{pelanggan_id}',[LaporanController::class,'getReportByPelangganID']);

    Route::get('laporan/per-periode',[LaporanController::class,'getViewFilter'])->name('laporan.filter-periode');

    Route::post('laporan/per-periode',
        [LaporanController::class,'getReportByDateRange'])->name('laporan.filter-date');

 
});
 
 
Route::prefix('user')->middleware('auth', 'role:user')->group(function () {
 
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.user');
    Route::get('/paketfoto',[PaketfotoController::class,'index'])->name('paketfoto.user');

    Route::get('/cart',[CartController::class,'index'])->name('cart.user');
    Route::get('/cart/lanjutkanpemesanan',[CartController::class,'lanjutkanPemesanan'])->name('cart.lanjutkanPemesanan');
    
    Route::post('/cart/lanjutpemesanan',[CartController::class,'lanjutpemesanan'])->name('lanjutpemesanan.user');
    Route::post('/cart/addto',[CartController::class,'addToCart'])->name('cart.addToCart');
    Route::get('/cart/delete/{id}',[CartController::class,'deleteCart'])->name('cart.deleteCart');

    Route::get('/cetakfoto',[CetakfotoController::class,'index'])->name('cetakfoto.user');
    Route::get('/pemesanan',[PemesananController::class,'index'])->name('pemesanan.admin');
    Route::get('/pemesanan/{id}',[PemesananController::class,'pesan']);
    Route::get('/pemesanan/{id}/delete',[PemesananController::class,'destroy']);
    Route::post('/pemesanan/{id}/simpan',[PemesananController::class,'simpan'])->name('pemesanan.simpan');
    Route::post('/pemesanan/cart/{id}',[PemesananController::class,'simpanCart'])->name('pemesanan.simpanCart');
    Route::get('/detailcetakfoto',[DetailcetakfotoController::class,'index'])->name('detailcetakfoto.admin');
    Route::get('/detailcetakfoto/{id}',[DetailcetakfotoController::class,'pesan']);
    Route::delete('/detailcetakfoto/delete/{id}',[DetailcetakfotoController::class,'destroy'])->name('detailcetakfoto.destroy');
    Route::post('/detailcetakfoto/{id}/simpan',[DetailcetakfotoController::class,'simpan'])->name('detailcetakfoto.simpan');
    Route::get('/galerifoto',[GalerifotoController::class,'index'])->name('galerifoto.user');
    Route::get('/laporan',[LaporanController::class,'index']);
    Route::get('laporan-view',[LaporanController::class,'getPreviewPDF']);
    Route::get('/detail', 'App\Http\Controllers\GalerifotoController@index')->name('detail');
});
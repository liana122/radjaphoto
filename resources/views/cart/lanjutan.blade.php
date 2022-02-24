@extends('layouts.admin')
 
@section('content')
<!-- @include('sweetalert::alert') -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- <h1 class="m-0"></h1> --}}
            </div><!-- /.col -->
 
 
        </div><!-- /.row -->
 
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
 
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Isi Detail Pemesanan</h3>
                    </div>
                    <div class="card">
                    <div class="card-header">
                    Detail Keranjang Pemesanan
                    </div>
                    <div class="card-body">
                    <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Produk</th>
                                    <th>Jenis Paket</th>
                                    <th>Jumlah Pesanan</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $paketfoto = ''; ?>
                                @foreach ($cart as $key=>$row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <?php $paketfoto = $row->jenispaket; ?>
                                    <td>{{ $row->keterangan }}</td>
                                    <td>{{$row->jenispaket}}</td>
                                    <td>{{ $row->jumlahPesanan }}</td>
                                    <td>{{ $row->hargaSatuan }}</td>
                                    <td>{{ $row->totalHarga }}
                            
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                @endforeach
 
 
                            </tbody>
                        </table>
                    </div>
 
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/user/detailcetakfoto/{{ $userid }}/simpan" method="POST" enctype="multipart/form-data">
                        <!-- <input type="hidden" name="produk_ids" value="{{ $cart->implode('produk_id', '-') }} "> -->
                        @csrf
                        <input type="hidden" value="{{$cetakfoto}}" name="foto">
                        <input type="hidden" name="produk_id" value="{{ $cart->implode('produk_id', '-') }}">
                        <input type="hidden" name="type_produk" value="{{ $cart->implode('type', '-') }}">
                        @foreach ( $cart as $row )
                        <input type="hidden" name="jenispaket" value="{{$row->jenispaket}}">
                        @endforeach
                        <div class="card-body">
                            <ul>
                                <li>No. Rek BRI : 008876372456754672</li>
                                <li>Harga Total Rp. : {{number_format($hargaTotal,2)}}</li>
                            </ul>
 
                            <div class="form-group">
                                <label for="namapemesan">Nama Pemesan</label>
                                <input type="text" class="form-control" id="namapemesan" name="namapemesan"
                                    placeholder="Nama Pemesan">
                            </div>
                            @if ($cart->implode('type', '-') == 'paketfoto')
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Alamat">
                            </div>
                            <div class="form-group">
                                <label for="tglfoto">Tanggal Foto</label>
                                <input type="date" class="form-control" id="tglfoto" name="tglfoto"
                                    placeholder="Tanggal foto">
                            </div>
                            @endif
                           

                            @if ($cart->implode('type', '-') == 'paketfoto')
                            <div class="form-group" style="display: none">
                                <label for="jumlahpesanan">Jumlah Pesanan</label>
                                <input type="hidden" class="form-control" id="jumlahpesanan" name="jumlahpesanan"
                                    placeholder="Jumlah Pesanan">
                            </div>
                            <div class="form-group" style="display: none">
                                <label for="exampleInputFile">Upload Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="foto" id="customFile" multifile="true">
                                    <label class="custom-file-label" for="customFile">Masukkan foto yang ingin dicetak</label>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="form-group">
                                <label for="jumlahpesanan">Jumlah Pesanan</label>
                                <input type="number" class="form-control" id="jumlahpesanan" name="jumlahpesanan"
                                    placeholder="Jumlah Pesanan">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Upload Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="foto[]" multiple id="customFile" multifile="true">
                                    <label class="custom-file-label" for="customFile">Masukkan foto yang ingin dicetak</label>
                                    </div>
                                </div>
                            </div>
                            @endif
                           
                            <div class="form-group">
                                <label for="no_telp">No. Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp"
                                    placeholder="Masukkan no. telepon">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Bukti Transfer</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="buktitransfer" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
 
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
 
 
 
@endsection
 
@section('script')
<script src="{{ asset('template/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(function () {
    bsCustomFileInput.init();
    });
</script>
@endsection
@extends('layouts.admin')
<script language="JavaScript" type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1 class="m-0">Riwayat Pemesanan</h1> -->
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<form action="{{route('cart.lanjutkanPemesanan', ['id'=> 11])}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                    <div class="col-9">
                        <h3 class="card-title">Keranjang Belanja <b> {{auth()->user()->name}}</b></h3>
                    </div>
                      <div class="col-3">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-shopping-bag"></i>
                            Lanjutkan Pemesanan
                        </button>
                    </div>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Gambar</th>
                                    <th>Produk</th>
                                    <th>Jenis Paket</th>
                                    <th>Jumlah Pesanan</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $key=>$row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img class="img-thumbnail" src="{{ asset('/gambar/'.$row->author.'/'.$row->gambar)}}" width="150"></td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td>{{$row->jenispaket}}</td>
                                    <td>{{ $row->jumlahPesanan }}</td>
                                    <td>{{ $row->hargaSatuan }}</td>
                                    <td>{{ $row->totalHarga }}</td>
                                    <td>
                                        <input type='checkbox' id="cart[]" name="cart_ids[]" value="{{ $row->id }} ">
                                        <input type='hidden' name="validate_id" value="{{ strlen($row->id) }} ">
                                    
                                    <a href="/user/cart/delete/{{ $row->id }}" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-sm btn-danger delete"><i class="fas fa-trash"></i></a>   
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
               
            </div>
            <!-- ./col -->
        </div>
{{-- <input type="text" name='id' /> --}}
{{-- <script>
$(document).ready(function() {
    //set initial state.
    $('#cart').change(function() {
        if(this.checked) {
            var returnVal = alert("Are you sure?");
            $(this).prop("checked", returnVal);
        }
        $('#textbox1').val(this.checked);        
    });
});
</script> --}}
    <!-- /.container-fluid -->
</section>
</form>

@endsection
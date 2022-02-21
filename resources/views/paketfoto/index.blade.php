@extends('layouts.admin')

@section('content')
<!-- @include('sweetalert::alert') -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1 class="m-0">Paket outdoor</h1> -->
            </div>

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Paket Foto</h3>
                        
                        @if (auth()->user()->role=='admin')
                        <a href="{{ route('paketfoto.tambah') }}" class="btn btn-primary btn-sm d-flex float-right"> + Tambah</a>
                        @endif

                        @if (session ('status'))
                            <div class="alert alert-info">
                                {{ session ('status')}}
                            </div>
                         @endif

                    </div>

                    <!-- /.card-header -->
                    
                    
                    <div class="card-body p-0">
                    <form action="user/transaksi/" method="post">
                        @csrf
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Gambar</th>
                                    <th>Jenis Paket</th>
                                    <th>Keterangan</th>
                                    <th>Harga</th>
                                    <th style="width: 40px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=>$row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><img class="img-thumbnail" src="{{ asset('/gambar/'.$row->author.'/'.$row->gambar)}}" width="150"></td>
                                    <td>{{ $row->jenispaket }}</td>
                                    <td>{{ $row->keterangan }}</td>
                                    <td>Rp {{ number_format($row->harga,0,',','.') }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            @if (auth()->user()->role=='user')
                                            <a data-toggle="modal" data-idproduk="{{$row->id}}" data-ket="{{$row->keterangan}}" data-target="#exampleModal" class="btn btn-info cartButton"><i class="fas fa-shopping-cart " ></i></a>
                                            
                                            <!-- <label>
                                                <a href="/{{ auth()->user()->role }}/pemesanan/{{ $row->id }}"></a>
                                                <input type='checkbox' name="paketfoto[]" value="id_paket">
                                             </label> -->
                                            @endif
                                            @if (auth()->user()->role=='admin')
                                            <a href="/admin/paketfoto/edit/{{ $row->id }}" class="btn btn-info"><i class="fas fa-pen"></i></a>
                                            <a href="/admin/paketfoto/{{ $row->id }}" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                        <!-- <button type="submit" class="btn btn-primary">Simpan</button> -->
                        </form> 
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- ./col -->
        </div>
        
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah ke Keranjang <b id="titleKeranjang"></p></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('cart.addToCart') }}" method="POST" >
                        @csrf
                        <div class="card-body">
                            
                            <input type="hidden" class="form-control" id="idProdukForm" name="idProduk">
                            <div class="form-group">
                                <label for="jumlahPesanan">Jumlah Pesanan</label>
                                <input type="number" class="form-control" id="jumlahPesanan" name="jumlahPesanan"
                                    placeholder="Jumlah Pesanan">
                            </div>
                            
                            
                        <!-- /.card-body -->
                        <div class="card-footer">
                           
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </div>
                </form>
    </div>
  </div>
</div>


        
    </div><!-- /.container-fluid -->
  
</section>







@endsection
@section("script")
<script>
    $(document).ready(function(){
        $(document).on("click",".cartButton", function(){
            let produk = $(this).data('ket');
            let idProduk = $(this).data('idproduk');
            console.log(idProduk)

            $("#titleKeranjang").html(produk)
            $("#idProdukForm").val(idProduk)
        })
    })
    </script>
@endsection
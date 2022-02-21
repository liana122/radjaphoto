@extends('layouts.admin')

@section('content')


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <h1 class="m-0">Detail Produk</h1> -->
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Detail Produk</h3>

                        @if (session ('status'))
                            <div class="alert alert-info">
                                {{ session ('status')}}
                            </div>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Nama Pemesan</th>
                                    <th>Produk</th>
                                    <th>Jumlah Pesanan</th>
                                    <th>Foto</th>
                                    <th>No Telepon</th>
                                    <th>Status</th>
                                    <th>Bukti Transfer</th>
                                    <th style="width: 40px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=>$row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row->namapemesan }}</td>
                                    <td>{{ $row->produk }}</td>
                                    <td>{{ $row->jumlahpesanan }}</td>
                                    <td>
                                        @php $fotoArray = explode(",", $row->foto) @endphp
                                        
                                       @foreach ($fotoArray as $foto)
                                           
                                            <img class="img-thumbnail"
                                                src="{{ asset('/foto/'.$row->author.'/'.$foto)}}" width="150">
                                        @if (auth()->user()->role=='admin')
                                            <p>
                                                <a href="{{ asset('/foto/'.$row->author.'/'.$foto)}}" download target="_blank"
                                                class="btn btn-success">Download</a>
                                            </p>
                                        
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $row->no_telp }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td><img class="img-thumbnail"
                                            src="{{ asset('/buktitransfer/'.$row->author_user.'/'.$row->buktitransfer)}}"
                                            width="150"></td>


                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            @if (auth()->user()->role=='user' && $row->status=='Menunggu Konfirmasi')
                                            <a href="/user/detailcetakfoto/{{ $row->detail_id }}/delete" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i></a>
                                            @endif
                                            
                                            
                                            @if (auth()->user()->role=='admin')
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#modal-{{$row->detail_id}}"><i class="fas fa-pen"></i></button>

                                            <a href="/admin/detailcetakfoto/{{ $row->detail_id }}/delete" class="btn btn-danger"><i
                                                class="fas fa-trash"></i></a>
                                            @endif
                                        </div>
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

    </div><!-- /.container-fluid -->

    @foreach ($data as $key => $row1)
        <div class="modal fade" id="modal-{{ $row1->detail_id }}" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/admin/detailcetakfoto/{{ $row1->detail_id }}/update" method="POST">
                    @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="Menunggu Konfirmasi" @if($row->status=='Menunggu Konfirmasi')selected @endif>Menunggu Konfirmasi</option>
                            <option value="Proses Mencetak" @if($row->status=='Proses Mencetak')selected @endif>Proses Mencetak</option>
                            <!-- <option value="Selesai Dicetak" @if($row->status=='Selesai Dicetak')selected @endif>Selesai Dicetak</option> -->
                            <option value="Selesai" @if($row->status=='Selesai')selected @endif>Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endforeach
    
</section>

@endsection
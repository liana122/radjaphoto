@extends('layouts.admin')

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
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    @if (session ('status'))
                            <div class="alert alert-info">
                                {{ session ('status')}}
                            </div>
                        @endif
                        <h3 class="card-title">Data Pemesanan</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Nama Pemesan</th>
                                    <th>Jenis Paket</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Foto</th>
                                    <th>No. Telepon</th>
                                    <th>Status</th>
                                    <th>Bukti Pembayaran</th>
                                    <th style="width: 40px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=>$row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row->namapemesan }}</td>
                                    <td>{{ $row->jenispaket }}</td>
                                    <td>{{ $row->alamat }}</td>
                                    <td>{{ $row->tglfoto }}</td>
                                    <td>{{ $row->no_telp }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td><img class="img-thumbnail"
                                            src="{{ asset('/buktipembayaran/'.$row->author.'/'.$row->buktipembayaran)}}"
                                            width="150"></td>


                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            @if (auth()->user()->role=='user' && $row->status=='Menunggu Konfirmasi')
                                            <a href="/user/pemesanan/{{ $row->id }}/delete" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-danger"><i
                                                    class="fas fa-trash"></i></a>
                                            @endif
                                            
                                            
                                            @if (auth()->user()->role=='admin')
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#modal-{{$row->id}}"><i class="fas fa-pen"></i></button>
                                                <a href="/admin/pemesanan/{{ $row->id }}/delete" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-danger"><i
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

    @foreach ($data as $row1)
        <div class="modal fade" id="modal-{{ $row1->id }}" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/admin/pemesanan/{{ $row1->id }}/update" method="POST">
                    @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="Menunggu Konfirmasi" @if($row->status=='Menunggu Konfirmasi')selected @endif>Menunggu Konfirmasi</option>
                            <option value="Lunas" @if($row->status=='Lunas')selected @endif>Lunas</option>
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
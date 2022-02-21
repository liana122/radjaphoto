@extends('layouts.admin')

@section('content')


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- <h1 class="m-0">Pesanan</h1> --}}
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
                        <h3 class="card-title">Laporan Transaksi</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No</th>
                                    <th>Nama Pemesan</th>
                                    <th>Tanggal Transaksi</th>
                                    @if (auth()->user()->role=='admin')
                                        
                                    <th style="width: 40px">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=>$row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row->namapemesan }}</td>
                                    <td>{{ $row->status }}</td>
                                    <td>{{ $row->created_at->format('d/m/Y') }}</td>
                                    @if (auth()->user()->role=='admin')
                                    <td>

                                        <a href="/admin/laporan/{{ $row->id }}/delete" class="btn btn-danger"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                    @endif
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



</section>

@endsection
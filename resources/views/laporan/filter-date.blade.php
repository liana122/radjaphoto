@extends('layouts.admin')

@section('content')


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
                        <form action="{{ route('laporan.filter-date') }} " method="post">
                    @csrf
                                <input type="date" name="dari_tanggal">
                            <input type="date" name="sampai_tanggal">
                            <button type="submit">Proses</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- ./col -->
        </div>

    </div><!-- /.container-fluid -->



</section>

@endsection
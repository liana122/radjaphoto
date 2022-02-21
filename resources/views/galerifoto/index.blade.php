@extends('layouts.admin')

@section('content')
<!-- @include('sweetalert::alert') -->
<style type="text/css">
    .pagination{
        float: left;
        list-style-type: none;
        margin:5px;
    }
</style>


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0"> List Galeri Foto </h3>
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
                        <!-- <h3 class="card-title">Galeri Foto</h3> -->
                        @if (auth()->user()->role=='admin')

                        @if (session ('status'))
                            <div class="alert alert-info">
                                {{ session ('status')}}
                            </div>
                         @endif

                        <a href="{{ route('galerifoto.tambah') }}" class="btn btn-primary btn-sm d-flex float-right"> + Tambah</a>
                         
                        <div class="row">
                            @foreach($galerifoto as $row)
                            <div class="col-lg-4 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ asset('gambar/admin/'.$row->gambar)}}"  style="height:100%;width:100%;">
                                        <form method="POST" action="/admin/galerifoto/{{ $row->id_galeri }}" class="d-inline">
                                            <!-- @csrf @method('EDIT')
                                            <button type="submit" class="btn btn-info"><i class="fas fa-edit"></i></button> -->
                                            </form>
                                            <a href="/admin/galerifoto/edit/{{ $row->id_galeri }}" class="btn btn-sm btn-info update"><i class="fas fa-pen"></i></a>
                                            <form method="POST" action="/admin/galerifoto/{{ $row->id_galeri }}" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin Ingin Menghapus Data?')" class="btn btn-sm btn-danger delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    {{-- <div class="table-responsive">
                        {{-- <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align:center; width:6%">No.</th>
                                    <th scope="col">Gambar</th>
                                    @if (auth()->user()->role=='admin')
                                    <th scope="col" style="text-align:center; width:15%">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($galeri as $key=>$row)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><img class="img-thumbnail" src="{{ asset('gambar/admin/'.$row->gambar)}}" width="150"></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            @if (auth()->user()->role=='user')
                                            <!-- <a href="/{{ auth()->user()->role }}/galerifoto/{{ $row->id_galeri }}" class="btn btn-info"></a> -->

                                            @endif
                                            @if (auth()->user()->role=='admin')
                                            <form method="POST" action="/admin/galerifoto/{{ $row->id_galeri }}" class="d-inline">
                                            <!-- @csrf @method('EDIT')
                                            <button type="submit" class="btn btn-info"><i class="fas fa-edit"></i></button> -->
                                            </form>
                                            <a href="/admin/galerifoto/edit/{{ $row->id_galeri }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            <form method="POST" action="/admin/galerifoto/{{ $row->id_galeri }}" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                            <!-- <a href="/admin/galerifoto/delete/{{ $row->id_galeri }}" class="btn btn-danger"><i class="fas fa-trash"></i></a> -->
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                @endforeach


                            </tbody>
                        </table> --}}

                    {{-- </div>
                    <!-- /.card-body -->
                </div>
            </div> --}}

            <!-- ./col -->
            @if (auth()->user()->role=='user')

            <div class="row">
                @foreach($galerifoto as $row)
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('gambar/admin/'.$row->gambar)}}"  style="height:100%;width:100%;">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        {{-- list data pagination --}}
        <div class="pagination">{{ $galerifoto->links() }}</div>
    </div><!-- /.container-fluid -->

</section>

@endsection
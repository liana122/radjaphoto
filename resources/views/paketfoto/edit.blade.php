@extends('layouts.admin')

@section('content')
@include('sweetalert::alert')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Data Paket Foto</h1>
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
                    <!-- <div class="card-header">
                        <h3 class="card-title">Quick Example</h3>
                    </div> -->
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/admin/paketfoto/edit/{{ $data->id }}/perbarui" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="gambar" id="customFile" value="{{ $data->gambar }}">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Paket</label>
                                <select class="form-control" name="jenispaket">
                                    <option @if($data->jenispaket=='Paket Outdoor') selected @endif value="Paket Outdoor">Paket Outdoor</option>
                                    <option @if($data->jenispaket=='Paket Studio') selected @endif value="Paket Studio">Paket Studio</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Keterangan</label>
                                <textarea class="form-control" name="keterangan" rows="3" placeholder="Enter ...">{{ $data->keterangan }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" value="{{ $data->harga }}"
                                    placeholder="Harga">
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
@extends('layouts.admin')
@section('title','galerifoto')
@section('content')
@include('sweetalert::alert')
<div class="content">
    <div class="card card-info card-outline">
        <div class="col-12">
        <div class="card-header">
            <h1 class="mt-4">Form Tambah Galeri Foto</h1>
        </div>
            <form method="post" role="form" action="{{url('admin/galerifoto/tambah/simpan')}}" enctype="multipart/form-data"> 
                @csrf
                <div class="card-header">
                <div class="card-body">
 
 
                <div class="col-6">
                    <label for="gambar" >Gambar</label>
                    <div class="file-upload">
                        <div class="file-select">
                            <input type="file" name="gambar" id="gambar">
                        </div>
                    </div>
                </div>
 
 
                <button type="submit" class="btn-primary my-3">Proses</button>
            </form>
            </div>
        </div>
    </div>
</div>
 
@endsection

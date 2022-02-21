@extends('layouts/admin')

@section('title','Galerifoto')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-10">
            <h3 class="mt-3">Detail galeri foto Nomor Id {{ $id_galeri}}</h3>   
            
            <div>
            {{ $data['gambar'] }}
            </div>
            <a  href="/admin/galerifoto" class="btn btn-success my-3"  >
                        List Galeri
            </a>
        </div>
    </div>
</div>
@endsection 
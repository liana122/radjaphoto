<?php

use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

function cekFileImage($path)
{
    $fileImage = File::exists($path);

    return $fileImage;
}

function createDirectory($createdDate)
{
    $path = public_path('foto/'.auth()->user()->name.'/'.Carbon::parse($createdDate)->format('d-m-Y'));

    if(!File::isDirectory($path)){
        $folderCreated = File::makeDirectory($path, 0777, true,true);
    }

    return $folderCreated;
}

function createMainDirectory($username)
{
    $path = public_path('foto/'.$username);

    if(!File::isDirectory($path)){
        $folderCreated = File::makeDirectory($path, 0777, true,true);
    }

    return $folderCreated;
}
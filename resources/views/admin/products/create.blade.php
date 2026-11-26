@extends('layouts.admin')

@section('title', 'Tambah Produk — Admin Zahran Kopi')
@section('page_title', 'Tambah Produk UMKM')
@section('page_subtitle', 'Tambahkan produk baru ke katalog marketplace Zahran Kopi')

@section('content')
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-8">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.products._form')
        </form>
    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Edit Produk — Admin @difMarket')
@section('page_title', 'Edit Produk: ' . $product->name)
@section('page_subtitle', 'Perbarui informasi atau gambar produk UMKM')

@section('content')
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-8">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.products._form', ['product' => $product])
        </form>
    </div>
@endsection

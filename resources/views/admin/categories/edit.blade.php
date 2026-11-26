@extends('layouts.admin')

@section('title', 'Edit Kategori — Admin @difMarket')
@section('page_title', 'Edit Kategori: ' . $category->name)
@section('page_subtitle', 'Perbarui informasi kategori produk UMKM')

@section('content')
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-8">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.categories._form', ['category' => $category])
        </form>
    </div>
@endsection

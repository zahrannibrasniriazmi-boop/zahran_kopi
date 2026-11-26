@extends('layouts.admin')

@section('title', 'Tambah Kategori — Admin Zahran Kopi')
@section('page_title', 'Tambah Kategori Baru')
@section('page_subtitle', 'Buat kategori produk baru untuk katalog Zahran Kopi')

@section('content')
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-8">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            @include('admin.categories._form')
        </form>
    </div>
@endsection

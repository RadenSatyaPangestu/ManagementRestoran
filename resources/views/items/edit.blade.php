@extends('layouts.app')

@section('content')
    <h1>Edit Data Barang</h1>
<form action="{{ route('items.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="kode_barang" class="form-label">Kode Barang</label>
        <input type="text" name="kode_barang" id="kode_barang" class="form-control" value="{{ old('kode_barang', $item->kode_barang) }}" required>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nama Barang</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $item->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', $item->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="lokasi_barang" class="form-label">Lokasi Barang</label>
        <input type="text" name="lokasi_barang" id="lokasi_barang" class="form-control" value="{{ old('lokasi_barang', $item->lokasi_barang) }}" required>
    </div>

    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <input type="text" name="kategori" id="kategori" class="form-control" value="{{ old('kategori', $item->kategori) }}" required>
    </div>

    <div class="mb-3">
        <label for="jenis_barang" class="form-label">Jenis Barang</label>
        <input type="text" name="jenis_barang" id="jenis_barang" class="form-control" value="{{ old('jenis_barang', $item->jenis_barang) }}" required>
    </div>

    <div class="mb-3">
        <label for="unit_satuan" class="form-label">Unit Satuan</label>
        <input type="text" name="unit_satuan" id="unit_satuan" class="form-control" value="{{ old('unit_satuan', $item->unit_satuan) }}" required>
    </div>

    <div class="mb-3">
        <label for="tanggal_pengadaan" class="form-label">Tanggal Pengadaan</label>
        <input type="date" name="tanggal_pengadaan" id="tanggal_pengadaan" class="form-control" value="{{ old('tanggal_pengadaan', $item->tanggal_pengadaan) }}">
    </div>

    <div class="mb-3">
        <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
        <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" class="form-control" value="{{ old('tanggal_kadaluarsa', $item->tanggal_kadaluarsa) }}">
    </div>

    <button type="submit" class="btn btn-primary">Perbarui Barang</button>
</form>

@endsection

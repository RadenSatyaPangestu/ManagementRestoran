@extends('layouts.app')

@section('content')
    <h1>Tambah Stok Barang</h1>
    <form action="{{ route('items.storeStock', $item->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menggunakan PUT karena update -->
        
        <div class="mb-3">
            <label for="stock" class="form-label">Jumlah Stok yang Ditambahkan</label>
            <input type="number" name="stock" id="stock" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-success">Tambah Stok</button>
    </form>
@endsection

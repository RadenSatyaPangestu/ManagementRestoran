@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        
        <form action="{{ route('expenses.store') }}" method="POST" class="p-4 rounded shadow-lg bg-white">
            @csrf
            <h2 class="text-center mb-4 text-uppercase fw-bold">Tambah Pengeluaran Barang</h2>

            <!-- Barang -->
            <div class="mb-4">
                <label for="item_id" class="form-label fw-semibold">Barang</label>
                <select name="item_id" id="item_id" class="form-select" required>
                    <option value="" disabled selected>Pilih Barang</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Peminjam -->
            <div class="mb-4">
                <label for="peminjam" class="form-label fw-semibold">Peminjam</label>
                <input type="text" name="peminjam" id="peminjam" class="form-control" placeholder="Nama Peminjam" required>
            </div>

            <!-- Jumlah Barang -->
            <div class="mb-4">
                <label for="quantity" class="form-label fw-semibold">Jumlah Barang</label>
                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Masukkan jumlah barang" required>
            </div>

            <!-- Tanggal Pengeluaran -->
            <div class="mb-4">
                <label for="date" class="form-label fw-semibold">Tanggal Pengeluaran</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>

            <!-- Tombol -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill shadow">Tambah Pengeluaran</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Set current date for the date field
        document.addEventListener('DOMContentLoaded', function () {
            const currentDate = new Date().toISOString().split('T')[0];
            document.getElementById('date').value = currentDate;
        });
    </script>
@endpush

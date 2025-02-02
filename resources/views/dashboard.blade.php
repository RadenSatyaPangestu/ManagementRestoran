<!-- resources/views/dashboard.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <h2>Notifikasi Stok Rendah</h2>
    @if($lowStockItems->isEmpty())
        <p>Tidak ada barang dengan stok rendah.</p>
    @else
        <ul>
            @foreach($lowStockItems as $item)
                <li>{{ $item->name }} - Stok: {{ $item->stock }}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const darkModeToggle = document.getElementById("darkModeToggle");
        const body = document.body;

        // Cek jika tema sudah disimpan sebelumnya
        if (localStorage.getItem("theme") === "dark") {
            body.classList.add("dark-mode");
            darkModeToggle.checked = true;
        }

        // Saat tombol diubah
        darkModeToggle.addEventListener("change", function () {
            if (this.checked) {
                body.classList.add("dark-mode");
                localStorage.setItem("theme", "dark"); // Simpan tema di Local Storage
            } else {
                body.classList.remove("dark-mode");
                localStorage.setItem("theme", "light");
            }
        });
    });
</script>
@endpush

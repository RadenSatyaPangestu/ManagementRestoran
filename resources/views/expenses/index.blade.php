@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Tambah Pengeluaran</a>
    <!-- Tombol Print -->
    <a href="{{ route('print.expenses') }}" class="btn btn-secondary" style="background-color: #2c3e50; border-color: #34495e; color: #ecf0f1;">
        <i class="fas fa-print"></i> Print Laporan
    </a>
</div>
    <table class="table">
        <thead>
            <tr>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Peminjam</th> <!-- Tambahkan kolom peminjam -->
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
                <tr>
                    <td>{{ $expense->item->name }}</td>
                    <td>{{ $expense->quantity }}</td>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->peminjam ?? '-' }}</td> <!-- Tampilkan nama peminjam, default '-' jika null -->
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

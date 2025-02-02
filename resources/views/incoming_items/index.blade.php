@extends('layouts.app')

@section('content')
<h1 class="mb-4">Daftar Barang Masuk</h1>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('incoming_items.create') }}" class="btn btn-primary">Tambah Barang Masuk</a>

    <form action="{{ route('incoming_items.index') }}" method="GET" class="d-flex align-items-center mb-0">
        <label for="date" class="me-2"></label>
        <input type="date" name="date" id="date" value="{{ request('date') }}" class="form-control me-2">
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Tombol Print -->
    <a href="{{ route('print.incomingItems') }}" class="btn btn-secondary" style="background-color: #2c3e50; border-color: #34495e; color: #ecf0f1;">
        <i class="fas fa-print"></i> Print Laporan
    </a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Supplier</th>
            <th>Jumlah</th>
            <th>Tanggal Diterima</th>
        </tr>
    </thead>
    <tbody>
        @foreach($incomingItems as $incomingItem)
        <tr>
            <td>{{ $incomingItem->item ? $incomingItem->item->name : 'Nama barang tidak tersedia' }}</td>
            <td>{{ $incomingItem->supplier ? $incomingItem->supplier->name : 'Supplier tidak tersedia' }}</td>
            <td>{{ $incomingItem->quantity }}</td>
            <td>{{ $incomingItem->received_date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
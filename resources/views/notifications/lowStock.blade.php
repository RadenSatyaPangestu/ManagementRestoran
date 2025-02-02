<!-- resources/views/notifications/lowStock.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Notifikasi Stok Rendah</h1>
    @if($lowStockItems->isEmpty())
        <p>Tidak ada barang dengan stok rendah.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Stok Tersisa</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lowStockItems as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->stock }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
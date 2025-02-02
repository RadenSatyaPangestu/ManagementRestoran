@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Daftar Barang</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

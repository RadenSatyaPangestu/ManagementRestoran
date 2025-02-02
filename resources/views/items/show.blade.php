@extends('layouts.app')

@section('content')
<div class="container">
    <h1>QR Code Barang</h1>
    <p>Scan QR Code untuk menambahkan stok barang.</p>
    
    <!-- QR Code dengan data item_id dan quantity -->
    <div>
        {!! $qrCode !!}
    </div>
</div>
@endsection

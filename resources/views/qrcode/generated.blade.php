@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>QR Code Generated</h1>
    <div class="my-4">
        {!! $qrCode !!}
    </div>
    <div>
        <h5>Data QR Code:</h5>
        <p><strong>Barang:</strong> {{ $data['item_id'] }}</p>
        <p><strong>Jumlah:</strong> {{ $data['quantity'] }}</p>
        <p><strong>Supplier:</strong> {{ $data['supplier_id'] }}</p>
    </div>
    <a href="{{ route('qrcode.create') }}" class="btn btn-primary mt-3">Generate Lagi</a>
</div>
@endsection

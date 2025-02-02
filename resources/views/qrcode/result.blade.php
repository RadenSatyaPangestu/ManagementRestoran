@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2>QR Code Berhasil Dibuat</h2>
    <div class="mt-4">
        {!! $qrCode !!}
    </div>
    <a href="{{ route('qrcode.create') }}" class="btn btn-secondary mt-3">Buat Lagi</a>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Generate QR Code</h1>
    <form action="{{ route('qrcode.generate') }}" method="POST">
        @csrf
        <!-- Pilih Barang -->
        <div class="mb-3">
            <label for="item_id" class="form-label">Pilih Barang</label>
            <select name="item_id" id="item_id" class="form-control select2" required>
                <option value="">-- Pilih Barang --</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Jumlah Barang -->
        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah Barang</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>

        <!-- Pilih Supplier -->
        <div class="mb-3">
            <label for="supplier_id" class="form-label">Pilih Supplier</label>
            <select name="supplier_id" id="supplier_id" class="form-control select2" required>
                <option value="">-- Pilih Supplier --</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">
                        {{ $supplier->name }} - {{ $supplier->phone }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Generate QR Code</button>
    </form>
</div>
@endsection

@push('scripts')
    <!-- Tambahkan Select2 untuk fitur pencarian -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fitur pencarian untuk item
            $('#item_id').select2({
                placeholder: 'Cari Barang',
                allowClear: true
            });

            // Fitur pencarian untuk supplier
            $('#supplier_id').select2({
                placeholder: 'Cari Supplier',
                allowClear: true
            });
        });
    </script>
@endpush

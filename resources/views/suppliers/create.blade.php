@extends('layouts.app')

@section('content')
<h1>Tambah Supplier</h1>

<form action="{{ route('suppliers.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Telepon</label>
        <input type="text" class="form-control" id="phone" name="phone">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Alamat</label>
        <textarea class="form-control" id="address" name="address"></textarea>
    </div>

    <!-- Pemilihan Barang yang Dipasok -->
    <div class="mb-3">
        <label for="items" class="form-label">Barang yang Dipasok</label>
        <select name="items[]" id="items" class="form-control select2 " multiple style="height: 200px;">
            @foreach($items as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection

@push('scripts')
    <!-- Tambahkan Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#items').select2({
                placeholder: "Pilih barang yang dipasok",
                allowClear: true,
                width: '100%' // Menyesuaikan dengan lebar form
            });
        });
    </script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Edit Supplier</h1>
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Supplier</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $supplier->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $supplier->phone) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $supplier->email) }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" name="address">{{ old('address', $supplier->address) }}</textarea>
            </div>

            <!-- Menambahkan pilihan item yang dipasok oleh supplier -->
            <div class="mb-3">
                <label for="items" class="form-label">Barang yang Dipasok</label>
                <select name="items[]" id="items" class="form-control select2" multiple style="height: 200px;">
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" 
                            @if(in_array($item->id, $supplier->items->pluck('id')->toArray())) selected @endif>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Supplier</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Inisialisasi Select2 untuk multiple select items
        $(document).ready(function() {
            $('#items').select2({
                placeholder: "Pilih barang yang dipasok",
                allowClear: true
            });
        });
    </script>
@endpush

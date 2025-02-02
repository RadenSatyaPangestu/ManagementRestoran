@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <form action="{{ route('items.store') }}" method="POST" class="p-4 rounded shadow-lg bg-white">
            @csrf
            <!-- Row 1 -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="kode_barang" class="form-label fw-bold">Kode Barang</label>
                    <input type="text" name="kode_barang" id="kode_barang" class="form-control" value="Pilih kategori terlebih dahulu" readonly>
                </div>

                <div class="col-md-6">
                    <label for="name" class="form-label fw-bold">Nama Barang</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama barang" required>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="mb-3">
                <label for="description" class="form-label fw-bold">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Deskripsi barang"></textarea>
            </div>

            <!-- Row 3 -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="stock" class="form-label fw-bold">Stok Awal</label>
                    <input type="number" name="stock" id="stock" class="form-control" placeholder="Jumlah stok awal" required>
                </div>
                <div class="col-md-6">
                    <label for="lokasi_barang" class="form-label fw-bold">Lokasi Barang</label>
                    <input type="text" name="lokasi_barang" id="lokasi_barang" class="form-control" placeholder="Lokasi penyimpanan" required>
                </div>
            </div>

            <!-- Row 4 -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="kategori" class="form-label fw-bold">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select" required>
                        <option value="" disabled selected>Pilih kategori barang</option>
                        <option value="kitchen">Kitchen</option>
                        <option value="bar">Bar</option>
                        <option value="service">Service</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="jenis_barang" class="form-label fw-bold">Jenis Barang</label>
                    <input type="text" name="jenis_barang" id="jenis_barang" class="form-control" placeholder="Jenis barang" required>
                </div>
            </div>

            <!-- Row 5 -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="unit_satuan" class="form-label fw-bold">Unit Satuan</label>
                    <select name="unit_satuan" id="unit_satuan" class="form-select" required>
                        <option value="" disabled selected>Pilih unit satuan</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Box">Box</option>
                        <option value="Kg">Kg</option>
                        <option value="Liter">Liter</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="tanggal_pengadaan" class="form-label fw-bold">Tanggal Pengadaan</label>
                    <input type="date" name="tanggal_pengadaan" id="tanggal_pengadaan" class="form-control" required>
                </div>
            </div>

            <!-- Row 6 -->
            <div class="mb-3">
                <label for="tanggal_kadaluarsa" class="form-label fw-bold">Tanggal Kadaluarsa</label>
                <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" class="form-control" placeholder="Opsional">
            </div>

            <!-- Row 7: Pilih Supplier (Multi-select) -->
            <div class="mb-3">
                <label for="suppliers" class="form-label fw-bold">Pilih Supplier <span class="text-danger">(Minimal 2)</span></label>
                <select name="suppliers[]" id="suppliers" class="form-select select2" multiple>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill shadow">Tambah</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const kategoriSelect = document.getElementById('kategori');
            const kodeBarangInput = document.getElementById('kode_barang');

            kategoriSelect.addEventListener('change', function () {
                let prefix = kategoriSelect.value.charAt(0).toUpperCase(); // K, B, atau S
                fetch(`/items/generate-code/${prefix}`)
                    .then(response => response.json())
                    .then(data => {
                        kodeBarangInput.value = data.kode_barang;
                    })
                    .catch(error => console.error('Error:', error));
            });

            // Set current date for tanggal_pengadaan field
            const currentDate = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_pengadaan').value = currentDate;

            $('#suppliers').select2({
                placeholder: "Pilih minimal 2 supplier",
                allowClear: true
            });
        });
    </script>
@endpush

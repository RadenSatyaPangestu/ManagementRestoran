@extends('layouts.app')

@section('content')
<h1>Tambah Barang Masuk</h1>

<form action="{{ route('incoming_items.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="supplier_id" class="form-label">Supplier</label>
        <select name="supplier_id" id="supplier_id" class="form-control" required>
            <option value="">Pilih Supplier</option>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="item_id" class="form-label">Barang</label>
        <select name="item_id" id="item_id" class="form-control" required>
            <option value="">Pilih Barang</option>
            <!-- Barang akan dimuat melalui Ajax setelah memilih supplier -->
        </select>
    </div>

    <div class="mb-3">
        <label for="quantity" class="form-label">Jumlah</label>
        <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
    </div>

    <div class="mb-3">
        <label for="received_date" class="form-label">Tanggal Diterima</label>
        <input type="date" name="received_date" id="received_date" class="form-control" required>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let today = new Date().toISOString().split('T')[0]; // Ambil tanggal hari ini dalam format YYYY-MM-DD
            document.getElementById("received_date").value = today;

            // Event listener untuk memilih supplier
            document.getElementById("supplier_id").addEventListener("change", function() {
                let supplierId = this.value;

                if (supplierId) {
                    // Lakukan Ajax request untuk mendapatkan barang yang dipasok oleh supplier
                    fetch("{{ route('get.items.by.supplier') }}?supplier_id=" + supplierId)
                        .then(response => response.json())
                        .then(data => {
                            let itemSelect = document.getElementById("item_id");
                            itemSelect.innerHTML = '<option value="">Pilih Barang</option>'; // Clear previous options

                            // Jika ada barang yang dipasok oleh supplier
                            if (data.length > 0) {
                                data.forEach(item => {
                                    let option = document.createElement("option");
                                    option.value = item.id;
                                    option.text = item.name;
                                    itemSelect.appendChild(option);
                                });
                            } else {
                                let option = document.createElement("option");
                                option.text = "Tidak ada barang tersedia";
                                itemSelect.appendChild(option);
                            }
                        })
                        .catch(error => console.error('Error fetching items:', error));
                } else {
                    // Jika tidak ada supplier yang dipilih, kosongkan dropdown item
                    document.getElementById("item_id").innerHTML = '<option value="">Pilih Barang</option>';
                }
            });
        });
    </script>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection

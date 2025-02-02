@extends('layouts.app')

@section('content')
<h1 class="mb-3">Daftar Supplier</h1>

<!-- Notifikasi Email Berhasil Dikirim -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="table-responsive">
    <table class="table table-sm table-bordered table-hover align-middle">
        <thead class="text-center">
            <tr>
                <th>ID</th>
                <th>Nama Supplier</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Barang yang Dipasok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suppliers as $supplier)
            <tr>
                <td class="text-center">{{ $supplier->id }}</td>
                <td class="text-nowrap">{{ $supplier->name }}</td>
                <td class="text-nowrap">{{ $supplier->phone ?? '-' }}</td>
                <td class="text-nowrap">{{ $supplier->email ?? '-' }}</td>
                <td class="text-nowrap">{{ $supplier->address ?? '-' }}</td>
                <td>
                    <div class="d-flex flex-wrap gap-1 overflow-auto" style="max-height: 80px;">
                        @forelse($supplier->items as $item)
                            <span class="badge bg-primary">{{ $item->name }}</span>
                        @empty
                            <span class="text-muted">Tidak ada barang</span>
                        @endforelse
                    </div>
                </td>
                <td class="text-center">
                    <div class="btn-group">
                        <button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Opsi
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('suppliers.edit', $supplier->id) }}"><i class="fas fa-edit"></i> Edit</a></li>
                            <li>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('Hapus supplier ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            </li>
                            @if($supplier->email)
                            <li>
                                <button class="dropdown-item text-primary" data-bs-toggle="modal" data-bs-target="#emailModal{{ $supplier->id }}">
                                    <i class="fas fa-envelope"></i> Kirim Email
                                </button>
                            </li>
                            @endif
                        </ul>
                    </div>
                </td>
            </tr>

            <!-- Modal Kirim Email -->
            @if($supplier->email)
            <div class="modal fade" id="emailModal{{ $supplier->id }}" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Kirim Email ke {{ $supplier->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('suppliers.sendEmail', $supplier->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <label for="message" class="form-label">Pesan:</label>
                                <textarea name="message" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            @endforeach
        </tbody>
    </table>
</div>

@endsection

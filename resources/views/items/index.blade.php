@extends('layouts.app')

@push('styles')
    <style>
        .sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

    </style>
@endpush


@section('content')
<section class="section main-section">
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <div>
            <span class="icon"><i class="mdi mdi-buffer"></i></span>
            <strong>Daftar Barang</strong>
        </div>
        <div>
            <a href="{{ route('items.create') }}" class="btn btn-success btn-sm">Tambah Data</a>
            <a href="{{ route('print.items') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-print"></i> Print Laporan
            </a>
        </div>
    </div>

    <!-- Form Pencarian dan Filter Kategori -->
    <form method="GET" action="{{ route('items.index') }}" class="mb-3 d-flex">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" class="form-control" name="search" placeholder="Cari Barang..." value="{{ request()->search }}">
        </div>
        <div class="category-box">
            <div class="form-select-wrapper">
                <i class="fas fa-list"></i>
                <select name="kategori" class="form-select" onchange="this.form.submit()"  
                style="
                border: none;
                outline: none;
                box-shadow: none;
                ">
                    <option value="">Semua Kategori</option>
                    <option value="Kitchen" {{ request()->kategori == 'Kitchen' ? 'selected' : '' }}>Kitchen</option>
                    <option value="Bar" {{ request()->kategori == 'Bar' ? 'selected' : '' }}>Bar</option>
                    <option value="Service" {{ request()->kategori == 'Service' ? 'selected' : '' }}>Service</option>
                </select>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox"/>
                        </th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Deskripsi</th>
                        <th>Lokasi</th>
                        <th>Jenis</th>
                        <th>Unit</th>
                        <th>Stok</th>
                        <th>Tanggal Pengadaan</th>
                        <th>Tanggal Kadaluarsa</th>
                        <th class="actions-cell">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>
                            <input type="checkbox"/>
                        </td>
                        <td data-label="Kode Barang">{{ $item->kode_barang }}</td>
                        <td data-label="Nama Barang">{{ $item->name }}</td>
                        <td data-label="Deskripsi">{{ $item->description }}</td>
                        <td data-label="Lokasi">{{ $item->lokasi_barang }}</td>
                        <td data-label="Jenis">{{ $item->jenis_barang }}</td>
                        <td data-label="Unit">{{ $item->unit_satuan }}</td>
                        <td data-label="Stok">{{ $item->stock }}</td>
                        <td data-label="Tanggal Pengadaan">{{ $item->tanggal_pengadaan ? $item->tanggal_pengadaan->format('d-m-Y') : '-' }}</td>
                        <td data-label="Tanggal Kadaluarsa">{{ $item->tanggal_kadaluarsa ? $item->tanggal_kadaluarsa->format('d-m-Y') : '-' }}</td>
                        <td class="actions-cell">
                            <div class="btn-group" role="group">
                                <a class="btn btn-success btn-sm" href="{{ route('items.addStock', $item->id) }}" title="Tambah Stok">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a class="btn btn-warning btn-sm" href="{{ route('items.edit', $item->id) }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Hapus" type="submit">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($items->isEmpty())
            <div class="alert alert-danger">
                <strong>Empty table.</strong> Tidak ada data yang tersedia.
            </div>
            @endif
        </div>
    </div>

    <div class="card-footer d-flex justify-content-center mt-4">
        {{ $items->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>
</section>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 14px;
            margin: 20px;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header img {
            max-width: 80px;
            margin-bottom: 10px;
        }
        header h1 {
            font-size: 24px;
            margin: 0;
        }
        header h2 {
            font-size: 18px;
            margin: 5px 0;
        }
        header p {
            margin: 5px 0;
            font-size: 14px;
        }
        hr {
            border: 1px solid #000;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        @media print {
            body {
                margin: 0;
            }
            table {
                page-break-inside: auto;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <!-- Template Header Formal -->
    <header>
        <img src="{{ asset('images/logo.png') }}" alt="Logo Restoran" />
        <h1>Restoran [Nama Restoran Anda]</h1>
        <h2>Laporan Barang</h2>
        <p>Alamat: Jl. Moh Toha, Bandung, Jawa Barat</p>
        <p>Telp: (021) 089669092752 | Email: info@Oltree.com</p>
        <p>Tanggal Cetak: <span id="current-date"></span></p>
    </header>
    <hr>

    <!-- Tabel Laporan -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Jenis</th>
                <th>Unit</th>
                <th>Stok</th>
                <th>Tanggal Pengadaan</th>
                <th>Tanggal Kadaluarsa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->lokasi_barang }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->jenis_barang }}</td>
                <td>{{ $item->unit_satuan }}</td>
                <td>{{ $item->stock }}</td>
                <td>{{ $item->tanggal_pengadaan ? $item->tanggal_pengadaan->format('d-m-Y') : '-' }}</td>
                <td>{{ $item->tanggal_kadaluarsa ? $item->tanggal_kadaluarsa->format('d-m-Y') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Script untuk Mengisi Tanggal Cetak -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const currentDate = new Date().toLocaleDateString("id-ID", {
                year: "numeric",
                month: "long",
                day: "numeric"
            });
            document.getElementById("current-date").textContent = currentDate;
        });
    </script>
</body>
</html>

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
<body onload="window.print()">
    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Peminjam</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
                <tr>
                    <td>{{ $expense->item->name }}</td>
                    <td>{{ $expense->quantity }}</td>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->peminjam ?? '-' }}</td>
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

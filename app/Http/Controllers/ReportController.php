<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Expense;
use App\Models\IncomingItem; // Import model IncomingItem
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends BaseController
{
    // Fungsi untuk mencetak laporan barang
    public function printItems()
    {
        $items = Item::all();
        return view('reports.printItems', compact('items'));

        // Buat view untuk laporan
        $pdf = Pdf::loadView('reports.items', compact('items'));
        
        // Unduh atau tampilkan di browser
        return $pdf->stream('laporan-barang.pdf');
    }

    // Fungsi untuk mencetak laporan pengeluaran
public function printExpenses()
{
    // Mengambil semua data pengeluaran dan memuat relasi ke 'item'
    $expenses = Expense::with('item')->get();

    // Mengembalikan view HTML (bisa digunakan untuk pratinjau atau debugging)
    return view('reports.printExpenses', compact('expenses'));

    // Kode berikut tidak akan dijalankan karena return view di atas menghentikan eksekusi.
    $pdf = Pdf::loadView('reports.printExpenses', compact('expenses'));

    // Menampilkan PDF di browser
    return $pdf->stream('laporan-pengeluaran.pdf');
}

public function printIncomingItems(Request $request)
{
    // Ambil tanggal yang dipilih dari request, default ke hari ini jika tidak ada
    $selectedDate = $request->input('date', Carbon::today()->toDateString());

    // Ambil data barang masuk berdasarkan tanggal yang dipilih
    $incomingItems = IncomingItem::with(['item', 'supplier'])
        ->whereDate('received_date', $selectedDate)
        ->get();

    // Tampilkan halaman pratinjau laporan sebelum dicetak
    return view('reports.printIncoming', compact('incomingItems', 'selectedDate'));
}



}

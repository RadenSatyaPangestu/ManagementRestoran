<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Item;
use Illuminate\Http\Request;

class ExpenseController extends BaseController
{
    // Menampilkan form untuk menambah pengeluaran
    public function create()
    {
        $items = Item::all(); // Ambil semua data barang
        return view('expenses.create', compact('items'));
    }

    // Menyimpan data pengeluaran
    public function store(Request $request)
{
    $request->validate([
        'item_id' => 'required|exists:items,id',
        'quantity' => 'required|integer|min:1',
        'peminjam' => 'required|string',
        'date' => 'required|date', // Validasi tanggal
    ]);

    Expense::create([
        'item_id' => $request->item_id,
        'quantity' => $request->quantity,
        'peminjam' => $request->peminjam,
        'date' => $request->date, // Pastikan tanggal disertakan
    ]);

    // Kurangi stok barang
    $item = Item::findOrFail($request->item_id);
    $item->stock -= $request->quantity;
    $item->save();

    return redirect()->route('expenses.index')->with('success', 'Pengeluaran barang berhasil ditambahkan.');
}


    // Menampilkan daftar pengeluaran
    public function index()
    {
        $expenses = Expense::all();
        return view('expenses.index', compact('expenses'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\IncomingItem;
use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class IncomingItemController extends BaseController
{
    // Menampilkan daftar barang masuk
public function index(Request $request)
{
    $selectedDate = $request->input('date', now()->toDateString());

    // Ambil data hanya yang tidak diarsipkan
    $incomingItems = IncomingItem::with(['item', 'supplier'])
        ->whereDate('received_date', $selectedDate)
        ->where('is_archive', false)
        ->latest()
        ->get();

    return view('incoming_items.index', compact('incomingItems', 'selectedDate'));
}

// Fungsi untuk mengarsipkan data kemarin
public function archiveOldData()
{
    IncomingItem::whereDate('received_date', '<', now()->toDateString())
        ->update(['is_archive' => true]);

    return redirect()->route('incoming_items.index')->with('success', 'Data lama berhasil diarsipkan!');
}

    // Menampilkan form tambah barang masuk
    public function create()
    {
        $items = Item::all();
        $suppliers = Supplier::all();
        return view('incoming_items.create', compact('items', 'suppliers'));
    }

    // Menyimpan data barang masuk
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|numeric|min:1',
            'received_date' => 'required|date',
        ]);

        // Simpan data barang masuk
        IncomingItem::create([
            'item_id' => $request->item_id,
            'supplier_id' => $request->supplier_id,
            'quantity' => $request->quantity,
            'received_date' => $request->received_date,
        ]);

        // Update stok barang
        $item = Item::find($request->item_id);
        $item->increment('stock', $request->quantity);

        return redirect()->route('incoming_items.index')->with('success', 'Barang masuk berhasil ditambahkan!');
    }

        // Mendapatkan barang yang dipasok oleh supplier tertentu
public function getItemsBySupplier(Request $request)
{
    $supplierId = $request->get('supplier_id');

    if ($supplierId) {
        // Mengambil barang yang dipasok oleh supplier
        $items = Supplier::find($supplierId)->items;  // Mengambil items yang dipasok oleh supplier
        
        return response()->json($items); // Mengembalikan data dalam format JSON
    }

    return response()->json([]);  // Jika tidak ada supplier_id, kembalikan array kosong
}






    // Fungsi untuk memproses QR Code (menambah stok barang dari QR Code)
    public function processQR(Request $request)
    {
        $data = json_decode($request->input('qr_data'), true);

        if (!isset($data['item_id']) || !isset($data['quantity']) || !isset($data['supplier_id']) || !isset($data['received_date'])) {
            return back()->with('error', 'QR Code tidak valid.');
        }

        $item = Item::find($data['item_id']);
        $supplier = Supplier::find($data['supplier_id']);

        if (!$item || !$supplier) {
            return back()->with('error', 'Barang atau Supplier tidak ditemukan.');
        }

        // Tambahkan stok barang
        $item->increment('stock', $data['quantity']);

        // Simpan data ke tabel incoming_items
        IncomingItem::create([
            'item_id' => $data['item_id'],
            'supplier_id' => $data['supplier_id'],
            'quantity' => $data['quantity'],
            'received_date' => $data['received_date'],
        ]);

        return redirect()->route('incoming_items.index')->with('success', 'Barang berhasil ditambahkan melalui QR Code!');
    }

    // Fungsi untuk generate QR Code
    public function generateQRCode(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
            'received_date' => 'required|date',
        ]);

        $data = [
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'supplier_id' => $request->supplier_id,
            'received_date' => $request->received_date,
        ];

        $qrCode = QrCode::size(250)->generate(json_encode($data));

        return view('qrcode.generated', compact('qrCode', 'data'));
    }
}

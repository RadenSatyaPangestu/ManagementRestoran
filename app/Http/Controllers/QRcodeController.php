<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\IncomingItem; // Tambahkan model IncomingItem jika belum ada
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;

class QRCodeController extends BaseController
{
    /**
     * Menampilkan form untuk generate QR Code.
     */
    public function create()
    {
        $items = Item::all();
        $suppliers = Supplier::all();
        return view('qrcode.create', compact('items', 'suppliers'));
    }

    /**
     * Proses generate QR Code.
     */
    public function generate(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        $data = [
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'supplier_id' => $request->supplier_id,
        ];

        $qrCode = QrCode::size(250)->generate(json_encode($data));
        return view('qrcode.generated', compact('data', 'qrCode'));
    }

    /**
     * Menampilkan halaman scan QR Code.
     */
    public function scan()
    {
        return view('qrcode.scan');
    }

    /**
     * Proses data dari QR Code yang di-scan.
     */
    public function process(Request $request)
    {
        $qrData = $request->input('qr_data');

        if (!$qrData) {
            return response()->json(['error' => 'Data QR Code tidak ditemukan.'], 400);
        }

        // Decode data QR Code
        $data = json_decode($qrData, true);

        if (!isset($data['item_id']) || !isset($data['quantity']) || !isset($data['supplier_id'])) {
            return response()->json(['error' => 'QR Code tidak valid.'], 400);
        }

        // Cari item berdasarkan ID
        $item = Item::find($data['item_id']);

        if (!$item) {
            return response()->json(['error' => 'Barang tidak ditemukan.'], 404);
        }

        try {
            // Tambahkan stok barang
            $item->increment('stock', $data['quantity']);

            // Tambahkan ke tabel incoming_items
            IncomingItem::create([
                'item_id' => $item->id,
                'supplier_id' => $data['supplier_id'],
                'quantity' => $data['quantity'],
                'received_date' => now(),
            ]);

            Log::info("Barang berhasil ditambahkan: ", $data);

            return response()->json([
                'success' => true,
                'message' => 'Barang berhasil masuk!',
            ], 200);

        } catch (\Exception $e) {
            Log::error("Kesalahan saat menambahkan barang: " . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat memproses data.'], 500);
        }
    }
}

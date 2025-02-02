<?php

namespace App\Http\Controllers;

use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Models\Item;
use Illuminate\Http\Request;


class BarcodeController extends BaseController
{
    // Menampilkan halaman untuk scan barcode
    public function index()
    {
        return view('scan-barcode');  // Pastikan ada view scan-barcode.blade.php untuk memindai barcode
    }

    // Generate Barcode sebagai HTML (untuk tampilan di halaman)
public function generateBarcode($productId)
{
    // Ambil produk berdasarkan ID
    $product = Item::findOrFail($productId);

    // Inisialisasi BarcodeGenerator
    $generator = new BarcodeGeneratorHTML();

    // Generate barcode menggunakan kode produk
    $barcode = $generator->getBarcode($product->barcode, BarcodeGeneratorHTML::TYPE_CODE_128);

    // Kirim ke view
    return view('barcode.show', compact('barcode', 'product'));
}


    // Generate Barcode dalam bentuk gambar PNG
public function generateBarcodeImage($productId)
{
    $product = Item::findOrFail($productId);

    // Inisialisasi BarcodeGeneratorPNG
    $generator = new BarcodeGeneratorPNG();

    // Generate barcode dalam format PNG
    $barcode = $generator->getBarcode($product->barcode, BarcodeGeneratorPNG::TYPE_CODE_128);

    // Simpan barcode sebagai file PNG
    $filePath = public_path('barcodes/' . $product->barcode . '.png');
    file_put_contents($filePath, $barcode);

    // Kirim file gambar ke view atau download
    return response()->file($filePath);
}


    // Menangani pemindaian barcode dan memperbarui stok barang
    public function scanAndUpdateStock(Request $request)
    {
        // Ambil data barcode dari request
        $barcode = $request->input('barcode');

        // Cari item berdasarkan barcode
        $item = Item::where('barcode', $barcode)->first();

        if ($item) {
            // Jika barang ditemukan, tambah stok sebanyak 10
            $item->stock += 10;
            $item->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Stok barang berhasil diperbarui!',
                'new_stock' => $item->stock
            ]);
        } else {
            // Jika barang tidak ditemukan
            return response()->json([
                'status' => 'error',
                'message' => 'Barang dengan barcode ini tidak ditemukan.'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\SupplierCategory;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    // Menampilkan semua item
    public function index(Request $request)
    {
        $query = Item::query();

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $items = $query->with('suppliers')->paginate(10);

        $categories = SupplierCategory::all();
        $suppliers = Supplier::all();

        return view('items.index', compact('items', 'categories', 'suppliers'));
    }

    // Menampilkan form untuk menambah item baru
    public function create()
    {
        $categories = SupplierCategory::all();
        $suppliers = Supplier::all();

        return view('items.create', compact('categories', 'suppliers'));
    }

    // Generate kode barang berdasarkan kategori
    public function generateCode($kategori)
    {
        $prefix = strtoupper(substr($kategori, 0, 1)); // K, B, atau S
        $lastItem = Item::where('kode_barang', 'LIKE', "{$prefix}%")->orderBy('id', 'desc')->first();

        if ($lastItem) {
            $lastNumber = (int) substr($lastItem->kode_barang, 1);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newCode = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        return response()->json(['kode_barang' => $newCode]);
    }

    // Menyimpan item baru
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'stock' => 'required|integer|min:1',
        'lokasi_barang' => 'required|string|max:255',
        'kategori' => 'required|string|in:kitchen,bar,service',
        'jenis_barang' => 'required|string|max:100',
        'unit_satuan' => 'required|string|max:50',
        'tanggal_pengadaan' => 'nullable|date',
        'tanggal_kadaluarsa' => 'nullable|date',
        'suppliers' => 'required|array|min:2',
    ]);

    // Tentukan prefix berdasarkan kategori
    $prefix = match ($request->kategori) {
        'kitchen' => 'K',
        'bar' => 'B',
        'service' => 'S',
        default => 'X', // Jika kategori tidak dikenal
    };

    // Cari kode barang terakhir yang memiliki prefix sesuai kategori
    $lastItem = Item::where('kode_barang', 'like', "{$prefix}%")
                    ->orderBy('kode_barang', 'desc')
                    ->first();

    if ($lastItem) {
        // Ambil angka terakhir dan tambahkan 1
        $lastNumber = (int) substr($lastItem->kode_barang, 1);
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }

    // Format kode barang baru
    $newCode = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    // Simpan item ke database
    $item = Item::create([
        'kode_barang' => $newCode,
        'name' => $request->name,
        'description' => $request->description,
        'stock' => $request->stock,
        'lokasi_barang' => $request->lokasi_barang,
        'kategori' => $request->kategori,
        'jenis_barang' => $request->jenis_barang,
        'unit_satuan' => $request->unit_satuan,
        'tanggal_pengadaan' => $request->tanggal_pengadaan,
        'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
    ]);

    // Simpan supplier ke tabel pivot
    $item->suppliers()->attach($request->suppliers);

    return redirect()->route('items.index')->with('success', "Barang $newCode berhasil ditambahkan!");
}


    // Menampilkan form edit untuk item tertentu
    public function edit(Item $item)
    {
        $categories = SupplierCategory::all();
        $suppliers = Supplier::all();
        $selectedSuppliers = $item->suppliers->pluck('id')->toArray();

        return view('items.edit', compact('item', 'categories', 'suppliers', 'selectedSuppliers'));
    }

    // Update data item
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lokasi_barang' => 'required|string|max:255',
            'kategori' => 'required|string|in:kitchen,bar,service',
            'jenis_barang' => 'required|string|max:100',
            'unit_satuan' => 'required|string|max:50',
            'tanggal_pengadaan' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date',
            'suppliers' => 'required|array|min:2',
        ]);

        // Update data barang
        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'lokasi_barang' => $request->lokasi_barang,
            'kategori' => $request->kategori,
            'jenis_barang' => $request->jenis_barang,
            'unit_satuan' => $request->unit_satuan,
            'tanggal_pengadaan' => $request->tanggal_pengadaan,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
        ]);

        // Perbarui relasi dengan supplier
        $item->suppliers()->sync($request->suppliers);

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui!');
    }

    // Menghapus item
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus.');
    }
}

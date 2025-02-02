<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Item; // Pastikan model Item sudah di-import
use App\Mail\SupplierMail;
use Illuminate\Support\Facades\Mail;

class SupplierController extends BaseController
{

public function index()
{
    $items = Item::all();  // Ambil semua barang yang ada
    $suppliers = Supplier::all();  // Ambil semua supplier (optional)
    
    return view('suppliers.index', compact('items', 'suppliers'));  // Kirim data barang dan supplier ke view
}

public function create()
{
    $items = Item::all();  // Ambil semua data barang (items)
    return view('suppliers.create', compact('items'));  // Kirim data items ke view
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        Supplier::create($request->all());
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function edit(Supplier $supplier)
    {
        $items = Item::all(); // Mengambil semua item yang ada
        return view('suppliers.edit', compact('supplier', 'items')); // Mengirimkan supplier dan items ke view
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:255',
            'items' => 'nullable|array', // Menambahkan validasi untuk items
        ]);

        // Update data supplier
        $supplier->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        // Update relasi many-to-many dengan items yang dipasok oleh supplier
        $supplier->items()->sync($request->items); // Sync untuk menyimpan item yang dipilih

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui!');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus!');
    }




public function sendEmail(Request $request, $id)
{
    $supplier = Supplier::findOrFail($id);

    $request->validate([
        'message' => 'required|string',
    ]);

    // Kirim email
    Mail::to($supplier->email)->send(new SupplierMail($supplier, $request->message));

    return redirect()->route('suppliers.index')->with('success', 'Email berhasil dikirim ke ' . $supplier->name);
}

}

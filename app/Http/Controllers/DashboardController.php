<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
use Faker\Provider\Base;

class DashboardController extends BaseController
{


public function index()
{
    $totalItems = Item::count();
    $totalSuppliers = Supplier::count();
    $stockStatus = 'Tersedia'; // Anda bisa memodifikasi ini sesuai logika status stok.
    $recentItems = Item::latest()->limit(5)->get();
    $lowStockItems = Item::getLowStockItems(5); // Ambil item dengan stok rendah
    $lowStockCount = $lowStockItems->count();
        $lowStockItems = Item::where('stock', '<', 5)->get();
    $lowStockCount = $lowStockItems->count(); // Hitung jumlah item dengan stok rendah

    
    return view('dashboard', compact('totalItems', 'totalSuppliers', 'stockStatus', 'recentItems', 'lowStockItems', 'lowStockCount'));
    return view('dashboard', compact('lowStockCount', 'lowStockItems'));
}
}

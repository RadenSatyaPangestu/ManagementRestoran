<?php

// MultipleFiles/NotificationController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class NotificationController extends BaseController
{

public function getLowStockNotifications()
{
    // Logika menghitung jumlah barang dengan stok rendah
    $lowStockCount = Item::where('stock', '<', 5)->count(); // Misal threshold-nya stok di bawah 10

    // Kirim data ke view
    return view('your-view-file', compact('lowStockCount'));
}
}
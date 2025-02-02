<?php
// api.php
use App\Models\Item;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth:sanctum')->get('/low-stock-items', function () {
    return response()->json(Item::getLowStockItems(10));
});



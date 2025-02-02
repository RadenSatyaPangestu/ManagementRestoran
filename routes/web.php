<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\IncomingItemController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\SettingController;

// Route menuju halaman Setting
Route::get('/settings', [SettingController::class, 'index'])->name('settings');



Route::post('/suppliers/{id}/send-email', [SupplierController::class, 'sendEmail'])->name('suppliers.sendEmail');



Route::post('/suppliers/{id}/send-email', [SupplierController::class, 'sendEmail'])->name('suppliers.sendEmail');



Route::get('/get-items-by-supplier', [IncomingItemController::class, 'getItemsBySupplier'])->name('get.items.by.supplier');


Route::resource('suppliers', SupplierController::class);

Route::get('/print-incoming-items', [IncomingItemController::class, 'printIncomingItems'])->name('print.incomingItems');

Route::get('/incoming-items', [IncomingItemController::class, 'index'])->name('incoming_items.index');
Route::post('/incoming-items/archive', [IncomingItemController::class, 'archiveOldData'])->name('incoming_items.archiveOldData');

Route::get('/qrcode/create', [QRCodeController::class, 'create'])->name('qrcode.create');
Route::post('/qrcode/generate', [QRCodeController::class, 'generate'])->name('qrcode.generate');
Route::get('/qrcode/scan', [QRCodeController::class, 'scan'])->name('qrcode.scan');
Route::post('/qrcode/process', [QRCodeController::class, 'process'])->name('qrcode.process');


Route::resource('items', ItemController::class)->except(['show']);


Route::post('/items/{item}/storeStock', [ItemController::class, 'storeStock'])->name('items.storeStock');

// Route untuk halaman show
Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');

Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');




// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Notifikasi route
Route::get('/notifications/low-stock', [NotificationController::class, 'getLowStockNotifications'])->name('notifications.low-stock');

// Cetak laporan
Route::get('/print/incoming-items', [ReportController::class, 'printIncomingItems'])->name('print.incomingItems');
Route::get('/print/expenses', [ReportController::class, 'printExpenses'])->name('print.expenses');
Route::get('/print/items', [ReportController::class, 'printItems'])->name('print.items');

// Resource routes
Route::resource('incoming_items', IncomingItemController::class)->middleware('auth');
Route::resource('suppliers', SupplierController::class)->middleware('auth');

// Redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');

// Halaman login dan logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Group route untuk autentikasi
Route::middleware('auth')->group(function () {
    // Rute untuk Item CRUD
    Route::resource('items', ItemController::class)->except(['edit', 'update', 'destroy']);
    
    // Rute tambahan untuk item
    Route::get('/items/{item}/add-stock', [ItemController::class, 'addStock'])->name('items.addStock');
    Route::put('/items/{item}/store-stock', [ItemController::class, 'storeStock'])->name('items.storeStock');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit'); // Tidak bertabrakan
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update'); // Tidak bertabrakan
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

    // Rute untuk pengeluaran
    Route::resource('expenses', ExpenseController::class);
});

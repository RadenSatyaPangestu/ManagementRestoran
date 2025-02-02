<?php

namespace App\Providers;
use Illuminate\Support\Facades\View; // Untuk View Composer
use App\Models\Item; // Untuk model Item

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void

{
    // Bagikan data ke semua view
    View::composer('*', function ($view) {
        $lowStockItems = Item::where('stock', '<', 5)->get(); // Barang dengan stok rendah
        $lowStockCount = $lowStockItems->count(); // Hitung jumlah barang

        $view->with('lowStockCount', $lowStockCount);
        $view->with('lowStockItems', $lowStockItems);
    });

            Paginator::useBootstrap();
}

}

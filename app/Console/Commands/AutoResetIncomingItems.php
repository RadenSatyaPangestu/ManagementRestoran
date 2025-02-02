<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\IncomingItem;
use Illuminate\Support\Facades\DB;

class AutoResetIncomingItems extends Command
{
    /**
     * Nama dan deskripsi perintah yang bisa dipanggil di terminal.
     */
    protected $signature = 'incoming_items:reset'; 
    protected $description = 'Mereset data barang masuk setiap hari dan menyimpannya ke dalam tabel history.';

    /**
     * Menjalankan perintah ini saat dijadwalkan.
     */
    public function handle()
    {
        // Simpan history sebelum menghapus data
        DB::table('incoming_item_histories')->insert(
            DB::table('incoming_items')->get()->map(function ($item) {
                return (array) $item; // Konversi objek ke array
            })->toArray()
        );

        // Hapus data dari tabel incoming_items
        IncomingItem::truncate();

        $this->info('Data incoming_items telah direset dan disimpan ke history.');
    }
}

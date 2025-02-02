<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToItemsTable extends Migration
{
    /**
     * Menjalankan migration.
     *
     * @return void
     */
    public function up()
    {
Schema::table('items', function (Blueprint $table) {
    $table->string('kode_barang')->nullable();
    $table->string('lokasi_barang')->nullable();
    $table->string('kategori')->nullable();
    $table->string('jenis_barang')->nullable();
    $table->string('unit_satuan')->nullable();
    $table->date('tanggal_pengadaan')->nullable();
    $table->date('tanggal_kadaluarsa')->nullable();
});

    }

    /**
     * Membatalkan migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn([
                'kode_barang',
                'lokasi_barang',
                'kategori',
                'jenis_barang',
                'unit_satuan',
                'tanggal_pengadaan',
                'tanggal_kadaluarsa',
            ]);
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('items', function (Blueprint $table) {
        $table->id(); // Auto increment primary key
        $table->string('kode_barang')->unique();
        $table->string('name');
        $table->text('description')->nullable();
        $table->integer('stock');
        $table->string('lokasi_barang');
        $table->string('kategori');
        $table->string('jenis_barang');
        $table->string('unit_satuan');
        $table->date('tanggal_pengadaan');
        $table->date('tanggal_kadaluarsa')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
    $table->string('name')->nullable();       // Tambahkan kolom name
    $table->text('description')->nullable(); // Tambahkan kolom description
    $table->integer('stock')->default(0);    // Tambahkan kolom stock
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            //
        });
    }
};

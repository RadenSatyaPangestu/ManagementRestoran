<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_xxxxxx_create_transactions_table.php

public function up()
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('item_id');
        $table->integer('quantity');
        $table->date('borrowed_at'); // Tanggal peminjaman
        $table->date('due_date'); // Tanggal pengembalian
        $table->enum('status', ['borrowed', 'returned'])->default('borrowed');
        $table->timestamps();

        $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

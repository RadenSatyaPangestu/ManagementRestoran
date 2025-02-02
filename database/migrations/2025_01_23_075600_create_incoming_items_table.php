<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingItemsTable extends Migration
{
    public function up()
    {
        Schema::create('incoming_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->date('received_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incoming_items');
    }
}

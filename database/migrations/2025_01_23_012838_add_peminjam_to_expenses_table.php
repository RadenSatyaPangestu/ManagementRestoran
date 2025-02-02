<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeminjamToExpensesTable extends Migration
{
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->string('peminjam')->nullable()->after('quantity'); // Menambahkan kolom 'peminjam'
            
        });
    }

    public function down()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('peminjam'); // Menghapus kolom 'peminjam' jika rollback
        });
    }
}

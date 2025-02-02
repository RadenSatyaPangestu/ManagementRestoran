<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Atribut yang dapat diisi melalui mass assignment
    protected $fillable = [
        'item_id',           // ID barang yang dipinjam
        'quantity',          // Jumlah barang yang dipinjam
        'borrowed_at',       // Waktu peminjaman
        'due_date',          // Tanggal pengembalian
        'status',            // Status peminjaman, seperti 'pinjam' atau 'kembali'
    ];

    // Relasi dengan model Item (Barang)
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Fungsi untuk mengurangi atau menambah stok barang
    public function updateStock()
    {
        $item = $this->item; // Ambil data item yang dipinjam

        // Jika status transaksi 'pinjam', kurangi stok
        if ($this->status == 'pinjam') {
            $item->decrement('stock', $this->quantity);
        } elseif ($this->status == 'kembali') { // Jika status 'kembali', tambahkan stok
            $item->increment('stock', $this->quantity);
        }
    }
}

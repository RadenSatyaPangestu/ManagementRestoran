<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'quantity',
        'description',
        'peminjam', // Kolom peminjam
        'date', // Kolom tanggal
    ];

    // Default value untuk kolom tertentu
    protected $attributes = [
        'date' => null, // Biarkan null secara default jika tidak diisi
    ];

    // Relasi dengan Item
    public function item()
    {
        return $this->belongsTo(Item::class); // Setiap pengeluaran terkait dengan satu barang
    }
}

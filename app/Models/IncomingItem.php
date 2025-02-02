<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',         // ID barang
        'supplier_id',     // ID supplier
        'quantity',        // Jumlah barang yang masuk
        'date',            // Tanggal barang masuk
        '_token',          // Token CSRF (opsional, tapi bisa diabaikan)
    ];

    // Relasi ke model Item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Relasi ke model Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}

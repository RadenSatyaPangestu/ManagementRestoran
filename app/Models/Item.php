<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika menggunakan default 'items')
    protected $table = 'items';

    // Mass assignable fields
    protected $fillable = [
        'name',
        'description',
        'stock',
        'kode_barang',
        'lokasi_barang',
        'kategori',
        'jenis_barang',
        'unit_satuan',
        'tanggal_pengadaan',
        'tanggal_kadaluarsa',
    ];

    // Data type casting
    protected $casts = [
        'tanggal_pengadaan' => 'datetime',
        'tanggal_kadaluarsa' => 'datetime',
        'stock' => 'integer',
    ];

    // Relasi ke Supplier (belongsTo)
public function suppliers()
{
return $this->belongsToMany(Supplier::class, 'supplier_item', 'item_id', 'supplier_id');
}


    // Relasi ke Incoming Items (hasMany)
    public function incomingItems()
    {
        return $this->hasMany(IncomingItem::class);
    }

    // Fungsi untuk mendapatkan barang dengan stok rendah
    public static function getLowStockItems($threshold = 10)
    {
        return self::where('stock', '<', $threshold)->get();
    }
}

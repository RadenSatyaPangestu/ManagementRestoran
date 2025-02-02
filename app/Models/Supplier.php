<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'email', 'address'];

public function items()
{
    return $this->belongsToMany(Item::class, 'supplier_item', 'supplier_id', 'item_id');
}


    public function incomingItems()
{
    return $this->hasMany(IncomingItem::class);
}


    public function category()
    {
        return $this->belongsTo(SupplierCategory::class, 'supplier_category_id');
    }




}

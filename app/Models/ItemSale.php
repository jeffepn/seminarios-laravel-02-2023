<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSale extends Model
{
    use HasFactory;

    // When necessary can provide a custom table name
    public $table = "item_sales";

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
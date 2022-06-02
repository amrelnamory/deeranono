<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')->withPivot(['quantity', 'selling_price', 'color', 'size']);
    } //end of products

}

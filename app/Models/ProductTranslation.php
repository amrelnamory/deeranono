<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'description', 'color', 'slug'];

    protected static function booted()
    {
        parent::boot();
        static::created(function ($product) {
            $product->slug = Str::slug($product->name);
            $product->save();
        });
    }
 
}

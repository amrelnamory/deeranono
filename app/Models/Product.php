<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use HasFactory;

    use Translatable;

    protected $guarded = [];

    public $translatedAttributes = ['name', 'description', 'color', 'slug'];

    protected $appends = ['image_path', 'discount_percent'];

    public function getImagePathAttribute()
    {
        return asset('uploads/products_images/');
    } //end of get image path

    public function getDiscountPercentAttribute()
    {
        $discount_percent = (($this->selling_price - $this->discount_price) / $this->selling_price) * 100 . ' %';
        return $discount_percent;
    } //end of get image path

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
 
}

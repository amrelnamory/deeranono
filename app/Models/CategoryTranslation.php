<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'slug'];


    protected static function booted()
    {
        parent::boot();
        static::created(function ($category) {
            $category->slug = Str::slug($category->name);
            $category->save();
        });
    }
}

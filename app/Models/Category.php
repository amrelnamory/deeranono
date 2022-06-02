<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;

class Category extends Model implements \Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable
{
    use HasFactory;

    use Translatable;

    protected $guarded = [];


    public $translatedAttributes = ['name', 'slug'];

    public function parents()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    public function parent_id()
    {
        return $this->belongsTo('\App\Models\Category', 'parent');
    }

    public function slugs()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/categories_images/' . $this->image);
    } //end of get image path

    public function getLocalizedRouteKey($locale)
    {
        return $this->slugs->where('locale', '=', $locale)->first()->slug;
    }

    public function resolveRouteBinding($slug, $field = null)
    {
        return static::whereHas('slugs', function ($q) use ($slug) {
            $q->where('slug', '=', $slug);
        })->firstOrFail() ?? abort(404);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Article extends Model implements TranslatableContract
{
    use HasFactory;

    use Translatable;

    protected $guarded = [];

    public $translatedAttributes = ['title', 'description', 'slug'];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/articles_images/');
    } //end of get image path

}

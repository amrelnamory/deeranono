<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ArticleTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title', 'description', 'slug'];


    protected static function booted()
    {
        parent::boot();
        static::created(function ($article) {
            $article->slug = Str::slug($article->title);
            $article->save();
        });
    }
}

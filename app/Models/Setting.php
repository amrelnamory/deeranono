<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['logo_path', 'favicon_path', 'collection_path', 'banner_path'];

    public function getLogoPathAttribute()
    {
        return asset('uploads/logos/' . $this->logo);
    } //end of get image path

    public function getFaviconPathAttribute()
    {
        return asset('uploads/logos/' . $this->favicon);
    } //end of get image path

    public function getCollectionPathAttribute()
    {
        return asset('uploads/banners/' . $this->collection_image);
    } //end of get image path

    public function getBannerPathAttribute()
    {
        return asset('uploads/banners/' . $this->banner_image);
    } //end of get image path
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $guarded = [];

    protected $appends = [
        'name',
        'full_image_path',
        'full_img_for_mob_path',
    ];

    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
    ];

    // === Multilingual support ===

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    // === Full image paths with fallback ===

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Categories', 'default.svg'));
    }

    public function getFullImgForMobPathAttribute()
    {
        return asset(getImagePathFromDirectory($this->img_for_mob, 'Categories/mobile', 'default.svg'));
    }
}

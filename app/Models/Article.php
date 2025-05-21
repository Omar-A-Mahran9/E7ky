<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $guarded = [];

    protected $appends = [
        'name',
        'content',
        'description',
        'full_image_path',
        'full_slide_image_path',
        'full_internal_image_path',
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

    public function getContentAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->content_ar : $this->content_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : $this->description_en;
    }

    // === Full image paths with fallback ===

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, '/', 'default.svg'));
    }

    public function getFullSlideImagePathAttribute()
    {
                return asset(getImagePathFromDirectory($this->slide_image, 'uploads', 'default.svg'));

        // return asset(getImagePathFromDirectory($this->slide_image, 'Articles/slides', 'default.svg'));
    }

    public function getFullInternalImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->internal_image, '', 'default.svg'));
    }// public/uploads/1482049942.jpg

        public function tags()
        {
            return $this->belongsToMany(Tag::class);
        }

        public function campaigns()
        {
            return $this->belongsToMany(Campaign::class);
        }
         public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

}

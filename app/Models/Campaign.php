<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns';

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

//  protected static function booted(): void
//     {
//         static::addGlobalScope('active', function (Builder $builder) {
//             $builder->where('status', 1);
//         });
//     }

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }



    // === Full image paths with fallback ===

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Campaigns', 'default.svg'));
    }

    public function getFullImgForMobPathAttribute()
    {
        return asset(getImagePathFromDirectory($this->img_for_mob, 'Campaigns/mobile', 'default.svg'));
    }
}

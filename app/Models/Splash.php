<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Splash extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $appends = ['name', 'description','full_image_path'];

    protected $casts = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d'];

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Splash', "default.svg"));
    }
    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }
    public function getDescriptionAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }
}

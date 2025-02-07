<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $guarded = [];
    protected $appends = ['name', 'description','full_image_path'];

    protected $casts = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d'];

    public function talks(): HasMany
    {
        return $this->hasMany(Talk::class, 'event_id', 'id');
    }

    public function workshops(): HasMany
    {
        return $this->hasMany(Workshop::class, 'event_id', 'id');
    }

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Events', "default.svg"));
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

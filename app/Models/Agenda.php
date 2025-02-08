<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Agenda extends Model
{
    use HasFactory;
    protected $table = "agenda";
    protected $appends = ['name', 'full_image_path'];
    protected $guarded = [];
    protected $casts   = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d', 'otp' => 'string'];


    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Customers', "default.svg"));
    }
    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }

    public function days(): BelongsToMany
    {
        return $this->belongsToMany(Day::class, 'days_events')
                    ->withTimestamps(); // Keep track of created_at & updated_at in pivot table
    }
}

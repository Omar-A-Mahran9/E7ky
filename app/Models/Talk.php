<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    use HasFactory;

    protected $appends = ['name', 'full_image_path'];
    protected $guarded = [];
    protected $casts   = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d', 'otp' => 'string'];



    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Customers', "default.svg"));
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }

}

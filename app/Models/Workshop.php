<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Workshop extends Model
{
    use HasFactory;

    protected $appends = ['name','description', 'full_image_path'];
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

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'customers_workshops')
                    ->withTimestamps(); // Keep track of created_at & updated_at in pivot table
    }


    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()];
    }

}

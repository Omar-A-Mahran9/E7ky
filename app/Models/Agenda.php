<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $table = ["agenda"];
    protected $appends = ['name', 'full_image_path'];
    protected $guarded = [];
    protected $casts   = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d', 'otp' => 'string'];


    public function getFullImagePathAttribute()
    {
        dd('paaoaom');

        return asset(getImagePathFromDirectory($this->image, 'Customers', "default.svg"));
    }
}

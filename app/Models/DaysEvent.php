<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaysEvent extends Model
{
    use HasFactory;
    use HasFactory;

    protected $guarded = [];
    protected $appends = [];

    protected $casts = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d'];


}

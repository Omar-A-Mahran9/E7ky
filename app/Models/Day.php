<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Day extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['name'];

    protected $casts = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d'];


    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }

    public function agendas(): BelongsToMany
    {
        return $this->belongsToMany(Agenda::class, 'days_events')
                    ->withTimestamps(); // Keep track of created_at & updated_at in pivot table
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'days_events')
                    ->withTimestamps(); // Keep track of created_at & updated_at in pivot table
    }
}

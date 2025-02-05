<?php

namespace App\Models;

use App\Models\Scopes\SortingScope;
use App\Traits\SMSTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    use SMSTrait;

    protected $appends = [ 'full_image_path'];
    protected $guarded = ["password_confirmation"];
    protected $casts   = ['created_at' => 'date:Y-m-d', 'updated_at' => 'date:Y-m-d', 'otp' => 'string'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new SortingScope());
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function talks(): BelongsToMany
    {
        return $this->belongsToMany(Talk::class, 'customers_talks')
                    ->withTimestamps(); // Keep track of created_at & updated_at in pivot table
    }

    public function workshops()
    {
        return $this->HasMany(Workshop::class);
    }
    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    }


    public function sendOTP()
    {
        $this->otp = rand(111111, 999999);
        $appName = setting("website_name") ?? "Platin";
        // $this->sendSMS("$appName: $this->otp هو رمز الحماية,لا تشارك الرمز");
        $this->save();
    }

    public function getFullImagePathAttribute()
    {
        return asset(getImagePathFromDirectory($this->image, 'Customers', "default.svg"));
    }
}

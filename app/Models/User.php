<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $fillable = [
        'name',
        'user_id',
        'email',
        'phone_number',
        'password',
        'image',
        'college',
        'batch',
        'division_id',
        'district_id',
        'upazila',
        'postOffice',
        'postCode',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public static function generateUniqueUserId()
    {
        $currentYear = now()->year % 100;
        $currentMonth = now()->month;
        // Format the user ID with a prefix (e.g., 231100001)
        return sprintf('%02d%02d%04d', $currentYear, $currentMonth, self::generateNextUserId());
    }

    private static function generateNextUserId()
    {
        return static::max('id') + 1;
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->user_id = self::generateUniqueUserId();
        });
    }
}

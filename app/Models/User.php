<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'refer_by',
        'email',
        'phone',
        'business',
        'password',
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function setPhoneAttribute($value)
    // {
    //     $this->attributes['phone'] = '+92 3'.$value;
    // }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }
    public function scopeFilterName($query ,$value)
    {
        if($value)
        {
            return $query->where('name','like',"%$value%");
        }
        return $query;
    }
    /**
     * Get the membership that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function membership()
    {
        return $this->belongsTo(MembershipCard::class, 'user_id', 'id');
    }

}

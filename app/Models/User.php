<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Library\UserQRCode;
use Backpack\CRUD\app\Models\Traits\CrudTrait; // <------------------------------- this one
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use CrudTrait;
    use HasRoles;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use UserQRCode;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'ref_code',
        'password',
        'fb_id',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'wallet'
    ];

    public function wallet() 
    {
        return $this->hasOne(Wallet::class);
    }

    public function getWalletAttribute()
    {
        return $this->wallet()->first();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function initials(){
        $words = explode(" ", $this->name);
        $initials = null;
        foreach ($words as $w) {
            $initials .= $w[0];
        }
        return strtoupper($initials);
    }

    public function myrecyclables()
    {
        return $this->hasMany(Recyclable::class, 'depositor_id');
    }

    public function mycollections()
    {
        return $this->hasMany(Recyclable::class, 'collector_id');
    }

    public function activities()
    {
        return Recyclable::where(function ($query) {
            $query->where('depositor_id', '=', $this->id)
                  ->orWhere('collector_id', '=', $this->id);
        })->latest()->limit(4)->get();
    }

    public function myreferrals()
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }
    
    public function ref_earnings()
    {
        return $this->myreferrals()->where('status', 'qualified')->count() * 500;
    }
}

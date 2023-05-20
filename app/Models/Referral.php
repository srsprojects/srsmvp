<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referrer_id',
        'referred_id',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'referrer_id' => 'integer',
        'referred_id' => 'integer',
    ];

    public function referrer()
    {
        return $this->belongsTo(User::class);
    }

    public function referred()
    {
        return $this->belongsTo(User::class);
    }
}

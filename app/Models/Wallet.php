<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'balance',
        'ledger',
        'wallet-phone',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'balance' => 'float',
        'ledger' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deposit(float $amount, string $bal = 'balance')
    {
        $this->$bal += $amount;
        $this->save();
        return $this->$bal;
    }

    public function withdraw(float $amount, string $bal = 'balance')
    {
        if ($this->$bal < $amount) {
            return false;
        }
        $this->$bal -= $amount;
        $this->save();
        return $this->$bal;
    }

    public function transfer(float $amount, Wallet $recipient)
    {
        if ($this->withdraw($amount)) {
            $recipient->deposit($amount);
        }
        return true;
    }
}

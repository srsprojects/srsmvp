<?php

namespace App\Library;

use App\Models\RecyclableType;
use App\Models\Transaction;
use App\Models\User;

trait RecyclableHelpers
{
    protected function calculateEarnings(User $depositor, RecyclableType $recyclableType, float $qty)
    {
        $role = $depositor->roles()->first();
        $recyclablePrice = 0;
        $recyclablePrice = $recyclableType->prices()->firstWhere('role','=',$role->name)->price_per_kg;       

        return $recyclablePrice * $qty;
    }

    protected function chargeEvents($payload)
    {
        $user = User::find($payload['meta']['user_id']);
        Transaction::create([
            'user_id' => $user->id,
            'amount' => 'float',
            'payload' => $payload,
            'type' => 'deposit',
            'ref' => $payload['tx_ref'],
            'status' => 'successful',
        ]);
        $user->wallet->deposit(floatval($payload['amount']));
    }
}

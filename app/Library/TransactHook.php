<?php

namespace App\Library;

use App\Models\Transaction;
use App\Models\User;

trait TransactHook
{
    protected function transferEvents($payload)
    {
        $trnx = Transaction::find($payload['meta']['trnx_id']);
        $trnx->status = Str::lower($payload['status']);
        $trnx->save();
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
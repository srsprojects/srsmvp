<?php

namespace App\Library;

use App\Models\Transaction;
use App\Models\User;

trait TransactHook
{
    protected function transferEvents($payload)
    {
        $trnx = Transaction::where('ref',$payload['data']['tx_ref']);
        $trnx->status = Str::lower($payload['data']['status']);
        $trnx->save();
    }

    protected function chargeEvents($payload)
    {
        $user = User::where('email', $payload['data']['customer']['email'])->first();
        Transaction::create([
            'user_id' => $user->id,
            'amount' => floatval($payload['data']['amount']),
            'payload' => $payload,
            'type' => 'deposit',
            'ref' => $payload['data']['tx_ref'],
            'status' => 'successful',
        ]);
        $user->wallet->deposit(floatval($payload['data']['amount']));
    }
}
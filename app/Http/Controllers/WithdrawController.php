<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.withdraw');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1000',
            'method' => 'required|string|max:30',
            'account_number' => 'nullable|numeric|digits:10',
            'bank' => 'nullable|numeric|digits_between:3,10'
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return $this->APIError($validator->errors(), 400);
            }
            throw new ValidationException($validator);
        }
        //dd($request->all());
        $payload = $request->except('_token', 'amount');
        $amount = floatval($request->amount);
        $user = Auth::user();
        if ($user->wallet->balance < $amount) {
            return back()->with(['error' => 'Insufficient Balance. Please continue earning!','toast'=>true]);
        }
        $trnx = Transaction::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'payload' => $payload,
            'type' => 'withdraw',
            'ref' => 'SRS-'.uniqid() . time(),
        ]);
        if ($payload['method'] == 'bank') {
            $payload['amount'] = $amount;
            $user->wallet->withdraw($amount);
            $this->initiateBankTransfer(json_decode(json_encode($payload)), $trnx);
        }
        return redirect(route('dashboard'))->with(['success' => 'Withdrawal Successful, Account is been Credited.', 'toast'=>true]);
    }

    public function initiateBankTransfer($payload, $trnx)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('FLW_PRV_KEY'),
        ])->post('https://api.flutterwave.com/v3/transfers', [
            'account_bank' => $payload->bank,
            'account_number' => $payload->account_number,
            'amount' => $payload->amount,
            'narration' => 'SRS Withdrawal',
            'currency' => 'NGN',
            'reference' => $trnx->ref,
            'meta' => [
                "user_id" => $trnx->user_id,
                "trnx_id" => $trnx->id
            ]
        ]);
        Log::info('Flutterwave Transfer Message: '.$response);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

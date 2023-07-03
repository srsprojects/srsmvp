<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.wallet');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deposit()
    {
        return view('app.deposit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdraw()
    {
        return view('app.withdraw');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Display the specified resource.
     *
     * @param  string  $phone
     * @return \Illuminate\Http\Response
     */
    public function balance($phone)
    {
        //
    }

    public function fundWalletMomo(Request $request)
    {
        // Get the user's phone number and amount from the request
        $phoneNumber = $request->input('phone_number');
        $amount = $request->input('amount'); // Log::debug($amount); Log::info($phoneNumber);

        // Make a request to MTN MoMo API to fund the wallet
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer YOUR_ACCESS_TOKEN',
                'Ocp-Apim-Subscription-Key' => 'YOUR_SUBSCRIPTION_KEY',
                'X-Target-Environment' => 'sandbox', // or 'production' for live environment
                'Content-Type' => 'application/json',
            ])->post('https://sandbox.momodeveloper.mtn.com/v1_0/apiuser/payment', [
                'amount' => $amount,
                'currency' => 'NGN',
                'externalId' => 'unique-transaction-id',
                'payer' => [
                    'partyIdType' => 'MSISDN',
                    'partyId' => $phoneNumber,
                ],
            ]);

            $statusCode = $response->status();
            $responseData = $response->json();

            // Process the response and update the user's wallet balance
            if ($statusCode == 200 && $responseData['status'] == 'SUCCESS') {
                // Update the user's wallet balance in your database
                // For example, if you have a User model and 'wallet_balance' field, you can do:
                // $user = User::where('phone_number', $phoneNumber)->first();
                // $user->wallet_balance += $amount;
                // $user->save();

                // Return a success response to the user
                return response()->json([
                    'message' => 'Wallet funded successfully',
                ]);
            } else {
                // Return an error response to the user
                return response()->json([
                    'message' => 'Failed to fund wallet',
                ], 400);
            }
        } catch (\Exception $e) {
            // Return an error response to the user
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
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

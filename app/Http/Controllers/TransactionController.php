<?php

namespace App\Http\Controllers;

use App\Library\TransactHook;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    use TransactHook;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.transactions');
    }

    /**
     * List Recyclablaes In Transaction history.
     *
     * @return \Illuminate\Http\Response
     */
    public function recyclables()
    {
        return view('app.transactions');
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

    /**
     * Accept Flutterwave Webhook and Process Request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function flwhook(Request $request)
    {
        Log::debug('Recieved Transaction Message \n' . ($request->json()));

        // If you specified a secret hash, check for the signature
        $secretHash = env('FLW_ENC_KEY');
        $signature = $request->header('verif-hash');
        if (!$signature || ($signature !== $secretHash)) {
            // This request isn't from Flutterwave; discard
            abort(401);
        }
        $payload = $request->all();

        switch ($payload['event']) {
            case 'transfer.completed':
                $this->transferEvents($payload);
                break;
            case 'charge.completed':
                $this->chargeEvents($payload);
                break;
            default:
                # code...
                break;
        }
        
        // Do something (that doesn't take too long) with the payload
        return response(200);
    }

    /**
     * Accept Paystack Webhook and Process Request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paystackhook(Request $request)
    {
        Log::debug('Recieved Transaction Message \n' . ($request->json()));
    }
}

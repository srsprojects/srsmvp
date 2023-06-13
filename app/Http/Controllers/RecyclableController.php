<?php

namespace App\Http\Controllers;

use App\Library\RecyclableHelpers;
use App\Models\Recyclable;
use App\Models\RecyclableType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RecyclableController extends Controller
{
    use RecyclableHelpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.recyclables');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = RecyclableType::all();
        return view('app.collect-recyblables', compact('categories'));
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
            'recyclable_type' => 'required|numeric|exists:recyclable_types,id',
            'phone' => 'required|exists:users,phone|numeric|digits:11',
            'qty' => 'required|numeric'
        ], [
            'recyclable_type.required' => 'The recyclable type field is required.',
            'recyclable_type.numeric' => 'The recyclable type must be a numeric value.',
            'recyclable_type.exists' => 'The selected recyclable type does not exist.',
            'phone.required' => 'The phone field is required.',
            'phone.exists' => 'The depositor does not exist.',
            'phone.numeric' => 'The phone number must be a numeric value.',
            'phone.digits' => 'The phone number must be exactly 11 digits.',
            'qty.required' => 'The quantity field is required.',
            'qty.numeric' => 'The quantity must be a numeric value.'
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return $this->APIError($validator->errors(), 400);
            }
            throw new ValidationException($validator);
        }
        //dd($request->all());
        $collector = Auth::user();
        $depositor = User::where('phone', $request->phone)->first();
        $recyclableType = RecyclableType::find($request->recyclable_type);
        //commented code because I have achieved the same result with the Validator
        /* if (empty($depositor)) {
            return back()->with(['error' => 'Depositor Does Not Exist', 'toast' =>true]);
        }
        if (empty($recyclableType)) {
            return back()->with(['error' => 'Recyclable Type Does Not Exist', 'toast' =>true]);
        } */
        $earnings = $this->calculateEarnings($depositor, $recyclableType, floatval($request->qty));
        //dd($earnings);

        if (!$collector->wallet->transfer($earnings, $depositor->wallet)) {
            return back()->with(['error' => "You have Insuffient balance to collect this order. \n You need a wallet balance of N $earnings to fulfil this collection.", 'toast' =>true]);
        }
        $recyclable = [
            'depositor_id' => $depositor->id,
            'collector_id' => $collector->id,
            'recyclable_type_id' => $recyclableType->id,
            'qty' => $request->qty,
            'earnings' => $earnings,
        ];

        Recyclable::create($recyclable);
        //notify users of transaction success.
        return back()->with(['success' => "Recyclable Collected Successfully.", 'toast' =>true]);
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

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Location;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:accounts',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'ref' => 'string|nullable',
            'phone' => 'string|nullable|max:20',
            'date_of_birth' => 'date|nullable',
            'address' => 'string|nullable|max:300',
            'latitude' => 'string|nullable|max:300',
            'longitude' => 'string|nullable|max:300'
        ]);

        if ($validator->fails()) {
            return $this->onError($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //Create and attach an Account
        $account = $user->account()->create([
            'username' => $request->username,
            'address' => $request->address,
            'phone' => $request->phone,
            'date_of_birth' => isset($request->date_of_birth) ? $request->date_of_birth : null,
            'ref_code' => generateRefCode($request->username)
        ]);

        //Create and attach a Wallet
        $wallet = $user->wallet()->create([
            'wallet_no' => generateWalletNo($user->id),
            'status' => 'active'
        ]);

        //attach Location data
        $location = Location::create([
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        $user->locations()->attach($location);

        //reward referrer
        if (isset($request->ref) && !empty($request->ref)) {
            $referrer = Account::where('ref_code', $request->ref)->first();
            if (!empty($referrer)) {
                Referral::create([
                    'referrer_id' => $referrer->user->id,
                    'referred_id' => $user->id
                ]);
                //TODO: Send Referral Notifications 
            }
        }
        $user->assignRole('homie');
        $token = $user->createToken('auth_token', [$user->getRoleNames()])->plainTextToken;

        $data = [
            'user' => $user, 'access_token' => $token, 'token_type' => 'Bearer',
        ];

        return $this->onSuccess($data);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return $this->onError($validator->errors(), 400);
        }
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->onError(['message' => 'Incorrect Email or Password'], 401, "UNAUTHORIZED");
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token', [$user->getRoleNames()])->plainTextToken;

        $data = [
            'user' => $user, 'access_token' => $token, 'token_type' => 'Bearer',
        ];

        return $this->onSuccess($data);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        $data = [
            'You have successfully logged out and the token was successfully deleted'
        ];
        return $this->onSuccess($data);
    }

    public function checkAuth()
    {
        if (auth('sanctum')->check()) {
            return $this->onSuccess('Valid Auth');
        }
        return $this->onError([],401);
    }
}

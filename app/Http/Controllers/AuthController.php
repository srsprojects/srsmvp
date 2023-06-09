<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Library\SMS;
use App\Models\Account;
use App\Models\Location;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:30',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'ref' => 'string|nullable',
            'phone' => 'required|string|max:20|unique:users',
            'date_of_birth' => 'date|nullable',
            'address' => 'string|nullable|max:300',
            'latitude' => 'string|nullable|max:300',
            'longitude' => 'string|nullable|max:300'
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return $this->APIError($validator->errors(), 400);
            }
            throw new ValidationException($validator);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'ref_code' => generateRefCode($request->name)
        ]);

        //Create and attach an Account
        /* $account = $user->account()->create([
            'username' => $request->username,
            'address' => $request->address,
            'phone' => $request->phone,
            'date_of_birth' => isset($request->date_of_birth) ? $request->date_of_birth : null,
            'ref_code' => generateRefCode($request->username)
        ]); */

        //Create and attach a Wallet
        $wallet = $user->wallet()->create([
            'wallet-phone' => $request->phone,
        ]);

        //attach Location data
        if (!empty($request->longitude && !empty($request->latitude))) {
            $location = [
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];
            $user->location()->create($location);
        }

        //reward referrer
        if (isset($request->ref) && !empty($request->ref)) {
            $referrer = User::where('ref_code', $request->ref)->first();
            if (!empty($referrer)) {
                Referral::create([
                    'referrer_id' => $referrer->user->id,
                    'referred_id' => $user->id
                ]);
                //TODO: Send Referral Notifications 
            }
        }
        //Assign User Role
        $user->assignRole($request->role);
        $token = $user->createToken('auth_token', [$user->getRoleNames()])->plainTextToken;

        $data = [
            'user' => $user, 'access_token' => $token, 'token_type' => 'Bearer',
        ];
        $sms = new SMS();
        $sms->internationalize($user->phone)
        ->setMessage("Hello $user->name! Welcome to SRS. \n You have taken the first step to keep our environment clean. 
        \n Go ahead and deposit your Recyclables with any Collection agents or hubs around you to start earning rewards. \n Visit www.srs.com.ng to learn more")
        ->send();
        Auth::login($user);
        if ($request->expectsJson()) {
            return $this->APISuccess($data);
        }
        return redirect(route('dashboard'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:255',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return $this->APIError($validator->errors(), 400);
            }
            throw new ValidationException($validator);
        }
        $authfactor = 'email';

        if(is_numeric($request->login)){
            $authfactor = 'phone';
        }
        $attmpt = [
            $authfactor => $request->login, 
            'password' => $request->password
        ]; //dd($attmpt);
        if (!Auth::attempt($attmpt)) {
            if ($request->expectsJson()) {
            return $this->APIError(['message' => 'Incorrect Login or Password'], 401, "UNAUTHORIZED");
            }
            $validator->getMessageBag()->add('current-password', 'Your current password does not matches with the password you provided or You have provided an Incorrect Phone Number or Email Address. Please try again.');
            throw new ValidationException($validator);
        }

        $user = User::where($authfactor, $request->login)->firstOrFail();

        $token = $user->createToken('auth_token', [$user->getRoleNames()])->plainTextToken;

        $data = [
            'user' => $user, 'access_token' => $token, 'token_type' => 'Bearer',
        ];

        Auth::login($user);
        if ($request->expectsJson()) {
            return $this->APISuccess($data);
        }
        return redirect(route('dashboard'));
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

    public function getUser($phone)
    {
        $user = User::where('phone', $phone)->first();
        if (empty($user)) {
            return $this->APIError([], 404, 'No Registered User Found');
        }
        return $this->APISuccess($user);
    }
}

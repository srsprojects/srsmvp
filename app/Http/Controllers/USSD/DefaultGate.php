<?php

namespace App\Http\Controllers\USSD;

use App\Http\Controllers\Controller;
use App\Library\SMS;
use App\Models\User;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Log;

class DefaultGate extends Controller
{
    public function USSDoutlet(Request $request)
    {
        $response = "END You have sent an Invalid Operand and SRS Is temporary Unable to handle your request, Please try again. Thank you for using SRS.";
        $text = $request->text;
        $phone = $request->phoneNumber;
        $sms = new SMS($phone);
        $user = User::where('phone', 'LIKE', '%' . domesticate($phone) . '%')->first(); //dd($user);
        //Log::log("DEBUG", json_encode($text)); 
        $params = explode('*', $text);
        if (empty($user)) {
            $response = "END You have no registered account on SRS. Kindly Register an account on www.srs.com.ng";
            $sms->setMessage("You have no registered account on SRS. Kindly Register an  account on www.srs.com.ng")->send();
        } else {
            if (isset($params[0]) && empty($params[0])) {
                $response  = "CON Welcome back to SRS " . $user->name . ", What would you like to do?\n \n";
                $response .= "1. Check your Wallet Balance \n";
                $response .= "2. Deposit Money \n";
                $response .= "3. Withdraw Earnings \n";
                $response .= "4. Collect Recyclables \n";
                $response .= "5. Contact Support \n";
            }
            if (isset($params[0]) && !empty($params[0]) && $params[0] == "1") {
                $message = "Your SRS Main Account Balance is NGN" . number_format($user->wallet->balance, 2);
                $response  = "END $message";

                $message .= "\n Your Ledger Balance is" . number_format($user->wallet->ledger, 2);
                $sms->setMessage($message)->send();
            } else if (is_numeric($params[0]) && $params[0] != "1") {
                $response = "END This Feature is Coming Soon.";
            }
        }
        // Echo the response back to the API
        header('Content-type: text/plain');
        echo $response;
    }
}

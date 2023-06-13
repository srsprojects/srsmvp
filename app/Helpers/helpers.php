<?php

use App\Library\ReferralCode;
use App\Models\Wallet;
use Backpack\PermissionManager\app\Models\Role;

function getRoles()
{
    return Role::all();
}

function getUserRoles(User $user)
{
    return $user->getRoles();
}

function generateRefCode($prefix): string
{
    $code = new ReferralCode($prefix);
    return $code->referralCode;
}

function generateWalletNo($user_id)
{
    // attempt to create a referral code until the one you have is unique
    do {
        $wallet_no = strrev(substr((int)($user_id / 5 * 10) . rand(pow(10, 10), pow(10, 11) - 1), 0, 10));
    } while (Wallet::where('wallet_no', $wallet_no)->exists() && strlen($wallet_no) == 10);

    return $wallet_no;
}

function containsMaliciousInput(String $stringToCheck = null)
{
    static $badInputs = [
        '<script>',
        '</script>',
        '<?>',
        '<?php>',
        '{{}}',
    ];
    $occurrence = 0;
    foreach ($badInputs as $a) {
        $occurrence += substr_count($stringToCheck, $a);
    }
    return $occurrence > 0;
}

function internationalize($phone, $countryCode = '+234')
{
    $formatted = $phone;
    // Check if the phone number is not already internationalized
    if (substr($phone, 0, 4) !== '+234') {
        // Convert the phone number to the international format
        $formatted = preg_replace('/^0/', '+234', $phone);
    } else if (substr($phone, 0, 3) == '234') {
        $formatted = "+" . $phone;
    }
    return $formatted;
}

function domesticate($phone)
{
    if (substr($phone, 0, 4) == '+234') {
        return preg_replace('/^\+234/', '0', $phone);
    } else if (substr($phone, 0, 3) == '234') {
        return preg_replace('/^234/', '0', $phone);
    }
    return $phone;
}

function getAllNigerianBanks()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.flutterwave.com/v3/banks/NG",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".env('FLW_PRV_KEY')
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    if ($response) {
        $res = json_decode($response);
        usort($res->data,function($a,$b) {return strnatcasecmp($a->name,$b->name);});

        return $res->data;
    }
    return [];
}

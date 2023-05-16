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
    foreach($badInputs as $a){
        $occurrence += substr_count($stringToCheck, $a);
    }
    return $occurrence > 0;
}

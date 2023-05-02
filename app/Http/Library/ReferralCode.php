<?php

namespace App\Http\Library;

use App\Models\Account;

class ReferralCode
{
    /**
     * Referral Code
     *
     * @var string
     */
    public $referralCode;

    /**
     * Username For Refcode Prefix
     *
     * @var string
     */
    protected $username;

    public function __construct($username) {
        $this->username = $username;
        $this->createReferralCode();
    }

    /**
     * Create a referral code and store it on the User.
     *
     * @return string
     */
    public function createReferralCode(): string
    {
        if (empty($this->referralCode)) {
            // attempt to create a referral code until the one you have is unique
            do {
                $referralCode = $this->generateReferralCode();
            } while ($this->hasUniqueReferralCode($referralCode));

            $this->referralCode = $referralCode;
        }
        
        return strtoupper($this->referralCode);
    }

    /**
     * Generate a referral code.
     *
     * @return string
     */
    protected function generateReferralCode(): string
    {
        // generate refcode
        $rand3digit = mt_rand(100,999);

        $strLength = strlen($this->username);
        $rmove = $strLength + 5/-1;

        $code = substr_replace($this->username, strval($rand3digit), 3, $rmove);

        return $code;
    }

    /**
     * Check if the referral code is unique.
     *
     * @param  string  $referralCode
     *
     * @return boolean
     */
    protected function hasUniqueReferralCode(string $referralCode): bool
    {
        // check against database to enforce uniqueness
        return Account::where('ref_code',$referralCode)->exists();
    }
}

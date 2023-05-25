<?php

namespace App\Library;

use AfricasTalking\SDK\AfricasTalking;

class SMS
{
    protected $message;
    private $phone;

    public function __construct($phone = null, $message = null)
    {
        $this->message = $message;
        $this->phone = $phone;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function internationalize($phone, $countryCode = '+234')
    {
        // Check if the phone number is not already internationalized
        if (substr($phone, 0, 4) !== '+234') {
            // Convert the phone number to the international format
            $this->phone = preg_replace('/^0/', '+234', $phone);
        }
        else if (substr($phone, 0, 3) == '234') {
            $this->phone = "+". $phone;
        }
        $this->phone = $phone;
        return $this;
    }

    public function domesticate($phone, $countryCode = '+234')
    {
        $formatted = preg_replace('/^\+234/', '0', $phone_number);
        $this->phone = $formatted;
        return $this;
    }

    public function send()
    {
        // Set your app credentials
        $username   = env('AT_USERNAME');
        $apiKey     = env('AT_APIKEY');

        // Initialize the SDK
        $AT         = new AfricasTalking($username, $apiKey);

        // Get the SMS service
        $sms        = $AT->sms();

        // Set your shortCode or senderId
        $from       = "SRS NG";

        try {
            // Thats it, hit send and we'll take care of the rest
            $result = $sms->send([
                'to'      => $this->phone,
                'message' => $this->message,
                'from'    => $from
            ]);

            return $result;
        } catch (Exception $e) {
            throw $e;
            echo "Error: " . $e->getMessage();
        }
    }
}

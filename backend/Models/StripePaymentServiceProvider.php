<?php

namespace Models;

use Interfaces\PaymentServiceProvider;
use Interfaces\Validator;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripePaymentServiceProvider implements PaymentServiceProvider
{
    
    private static $api_key;

    private Validator $validator;

    public function __construct(Validator $validator) {
        self::$api_key = $_ENV["STRIPE_API_KEY"];

        $this->validator = $validator;
    }

    public function makePayment(array $data) {
        $validation_result = $this->validator->validate($data);

        if (!$validation_result["result"]) {
            return $validation_result;
        }

        $stripe = new StripeClient(self::$api_key);

        try {
            $token_response = $stripe->tokens->create([
                'card' => [
                    'number' => $data["card"]["number"],
                    'exp_month' => $data["card"]["expiry_month"],
                    'exp_year' => $data["card"]["expiry_year"],
                    'cvc' => $data["card"]["cvc"],
                ],
            ]);
        } catch (\Exception $ex) {
            return [ "result" => false, "message" => "Error obtaining token from the gateway", "data" => [], "code" => 503 ];
        }

        Stripe::setApiKey(self::$api_key);

        try {
            $charge_response = Charge::create([
                "amount" => $data["amount"],
                "currency" => $data["currency"],
                "description" => $data["description"],
                "source" => $token_response->id
            ]);
        } catch (\Exception $ex) {
            return [ "result" => false, "message" => "Error while sending payment to the gateway", "data" => [], "code" => 503 ];
        }

        return [ 
            "result" => true,
            "message" => "Payment successful",
            "data" => [
                "id" => $charge_response->id,
                "amount" => $charge_response->amount,
                "currency" => strtoupper($charge_response->currency),
                "created" => $charge_response->created
            ]
        ];
    }

}
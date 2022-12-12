<?php

namespace Models;

use Interfaces\HttpConnection;
use Interfaces\PaymentServiceProvider;
use Interfaces\Validator;

class PinPaymentServiceProvider implements PaymentServiceProvider
{
    
    private static $api_key;
    private static $api_endpoint;

    private HttpConnection $connection;
    private Validator $validator;

    public function __construct(HttpConnection $connection, Validator $validator) {
        self::$api_key = $_ENV["PIN_API_KEY"];
        self::$api_endpoint = $_ENV["PIN_ENDPOINT_URL"];

        $this->connection = $connection;
        $this->validator = $validator;
    }

    public function makePayment(array $data) {
        $this->connection->setUrl(self::$api_endpoint);

        $validation_result = $this->validator->validate($data);

        if (!$validation_result["result"]) {
            return $validation_result;
        }

        $result = json_decode($this->connection->setOption(CURLOPT_USERPWD, self::$api_key . ":" . "")->setData($data)->execute(), true);

        return [ 
            "result" => true, 
            "message" => "Payment successful", 
            "data" => [
                "id" => $result["response"]["token"],
                "amount" => $result["response"]["amount"],
                "currency" => $result["response"]["currency"],
                "created" => strtotime($result["response"]["created_at"])
            ]
        ];
    }

}
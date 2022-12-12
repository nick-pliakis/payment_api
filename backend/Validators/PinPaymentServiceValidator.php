<?php

namespace Validators;

use Interfaces\Validator;
use Validators\PaymentServiceValidator;

class PinPaymentServiceValidator extends PaymentServiceValidator implements Validator
{

    private $mandatory_fields = [ "amount", "currency", "description", "card", "email" ];
    private $card_mandatory_fields = [ "number", "expiry_month", "expiry_year", "cvc", "name", "address_line1", 
                                        "address_city", "address_postcode", "address_state", "address_country" ];

    public function validate(array $data) {
        $message = "Validation successful";

        foreach ($this->mandatory_fields as $mandatory_field) {
            if (!isset($data[$mandatory_field])) {
                return [ "result" => false, "message" => "Missing required field: " . $mandatory_field ];
            }
        }

        foreach ($this->card_mandatory_fields as $card_mandatory_field) {
            if (!isset($data["card"][$card_mandatory_field])) {
                return [ "result" => false, "message" => "Missing card required field: " . $mandatory_field ];
            }
        }

        if (!$this->isEmail($data["email"])) {
            return [ "result" => false, "message" => "Malformed email" ];
        } 

        if (!$this->isFloat($data["amount"])) {
            return [ "result" => false, "message" => "Amount value is not correct" ];
        } 

        if (!$this->isValidCardLength($data["card"]["number"])) {
            return [ "result" => false, "message" => "Malformed card number" ];
        } 

        if (!$this->isValidCvcLength($data["card"]["cvc"])) {
            return [ "result" => false, "message" => "Malformed CVC number" ];
        }
        
        if (!$this->isValidExpiryMonth($data["card"]["expiry_month"])) {
            return [ "result" => false, "message" => "Invalid expiry month" ];
        }
        
        if (!$this->isValidExpiryYear($data["card"]["expiry_year"])) {
            return [ "result" => false, "message" => "Invalid expiry year" ];
        }

        return [ "result" => true, "message" => $message ];
    }

}
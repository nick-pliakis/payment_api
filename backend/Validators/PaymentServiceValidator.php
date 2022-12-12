<?php

namespace Validators;

use Interfaces\Validator;

abstract class PaymentServiceValidator implements Validator
{

    public function isEmail($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public function isFloat($value) {
        return filter_var($value, FILTER_VALIDATE_FLOAT);
    }

    public function isValidCardLength($value) {
        return strlen($value) === (int)$_ENV["CARD_NUMBER_LENGTH"];
    }

    public function isValidCvcLength($value) {
        return strlen($value) === (int)$_ENV["CARD_CVC_LENGTH"];
    }

    public function isValidExpiryMonth($value) {
        return filter_var($value, FILTER_VALIDATE_INT) && $value > 0 && $value <= 12;
    }

    public function isValidExpiryYear($value) {
        if (strlen($value) === 2) {
            return (int)$value > (int)date("y"); 
        } else if (strlen($value) === 4) {
            return (int)$value > (int)date("Y"); 
        } else {
            return false;
        }
    }

}
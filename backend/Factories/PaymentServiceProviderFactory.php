<?php

namespace Factories;

use Interfaces\HttpConnection;

use Models\PinPaymentServiceProvider;
use Models\StripePaymentServiceProvider;

use Validators\PinPaymentServiceValidator;
use Validators\StripePaymentServiceValidator;

class PaymentServiceProviderFactory
{

    public static function create($psp_name, HttpConnection $connection) {
        if ($psp_name === "pin") {
            return new PinPaymentServiceProvider($connection, new PinPaymentServiceValidator());
        } else if ($psp_name === "stripe") {
            return new StripePaymentServiceProvider(new StripePaymentServiceValidator());
        }
    }

}
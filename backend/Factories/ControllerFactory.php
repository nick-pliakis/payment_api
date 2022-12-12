<?php

namespace Factories;

use Authenticators\PaymentAuthenticator;
use Controllers\PaymentController;
use Transformers\ResponseTransformer;

class ControllerFactory
{

    public static function create($controller_name, ResponseTransformer $response) {
        if ($controller_name === "payment") {
            return new PaymentController(new PaymentAuthenticator(), $response);
        }
    }

}
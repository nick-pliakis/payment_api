<?php

namespace Interfaces;

use Interfaces\HttpConnection;

interface PaymentServiceProvider
{
    
    public function makePayment(array $additional_data);

}
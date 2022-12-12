<?php

use Connectors\CurlConnection;
use Controllers\PaymentController;
use Factories\ControllerFactory;
use Factories\PaymentServiceProviderFactory;
use Interfaces\PaymentServiceProvider;
use Transformers\ResponseTransformer;

use PHPUnit\Framework\TestCase;

final class FactoryTest extends TestCase
{

    public function testControllerFactoryGeneratesController(): void {
        $this->assertInstanceOf(PaymentController::class, ControllerFactory::create("payment", new ResponseTransformer()));
    }

    public function testPaymentServiceProviderFactoryGeneratesPaymentServiceProviderWithPin(): void {
        $this->assertInstanceOf(PaymentServiceProvider::class, PaymentServiceProviderFactory::create("pin", CurlConnection::getInstance()));
    }

    public function testPaymentServiceProviderFactoryGeneratesPaymentServiceProviderWithStripe(): void {
        $this->assertInstanceOf(PaymentServiceProvider::class, PaymentServiceProviderFactory::create("stripe", CurlConnection::getInstance()));
    }

}
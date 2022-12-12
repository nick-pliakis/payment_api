<?php

require __DIR__ . "/../config/initialize.php";

use Connectors\CurlConnection;
use Connectors\MysqlConnection;
use Interfaces\DatabaseConnection;
use Interfaces\HttpConnection;
use Interfaces\PaymentServiceProvider;
use Models\PinPaymentServiceProvider;
use Models\StripePaymentServiceProvider;
use Validators\PinPaymentServiceValidator;

use PHPUnit\Framework\TestCase;
use Validators\StripePaymentServiceValidator;

final class InterfaceTest extends TestCase
{

    public function testCurlConnectionImplementsHttpConnectionInterface(): void {
        $this->assertInstanceOf(HttpConnection::class, CurlConnection::getInstance());
    }

    public function testMysqlConnectionImplementsDatabaseConnectionInterface(): void {
        $this->assertInstanceOf(DatabaseConnection::class, MysqlConnection::getInstance());
    }

    public function testPinPaymentServiceProviderImplementsPaymentServiceProviderInterface(): void {
        $this->assertInstanceOf(PaymentServiceProvider::class, new PinPaymentServiceProvider(CurlConnection::getInstance(), new PinPaymentServiceValidator()));
    }

    public function testStripePaymentServiceProviderImplementsPaymentServiceProviderInterface(): void {
        $this->assertInstanceOf(PaymentServiceProvider::class, new StripePaymentServiceProvider(new StripePaymentServiceValidator()));
    }

}
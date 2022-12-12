<?php

use Models\PinPaymentServiceProvider;
use PHPUnit\Framework\TestCase;
use Validators\PaymentServiceValidator;
use Validators\PinPaymentServiceValidator;
use Validators\StripePaymentServiceValidator;

final class ValidatorTest extends TestCase
{

    public function testPinPaymentServiceValidatorIsPaymentServiceValidator(): void {
        $this->assertInstanceOf(PaymentServiceValidator::class, new PinPaymentServiceValidator());
    }

    public function testStripePaymentServiceValidatorIsPaymentServiceValidator(): void {
        $this->assertInstanceOf(PaymentServiceValidator::class, new StripePaymentServiceValidator());
    }
    
    public function testPinPaymentServiceValidatorInvalidEmail(): void {
        $pin_validator = new PinPaymentServiceValidator();
        $this->assertFalse($pin_validator->isEmail("wrong email"));
    }

    public function testPinPaymentServiceValidatorInvalidAmount(): void {
        $pin_validator = new PinPaymentServiceValidator();
        $this->assertFalse($pin_validator->isFloat("wrong float"));
    }

    public function testPinPaymentServiceValidatorInvalidCardLength(): void {
        $pin_validator = new PinPaymentServiceValidator();
        $this->assertFalse($pin_validator->isValidCardLength("999999999999999999"));
    }

    public function testPinPaymentServiceValidatorInvalidCvcLength(): void {
        $pin_validator = new PinPaymentServiceValidator();
        $this->assertFalse($pin_validator->isValidCvcLength("4444"));
    }

    public function testPinPaymentServiceValidatorInvalidExpiryMonth(): void {
        $pin_validator = new PinPaymentServiceValidator();
        $this->assertFalse($pin_validator->isValidExpiryMonth(15));
    }

    public function testPinPaymentServiceValidatorInvalidExpiryYear(): void {
        $pin_validator = new PinPaymentServiceValidator();
        $this->assertFalse($pin_validator->isValidExpiryYear(2018));
    }
    
    public function testStripePaymentServiceValidatorInvalidEmail(): void {
        $stripe_validator = new StripePaymentServiceValidator();
        $this->assertFalse($stripe_validator->isEmail("wrong email"));
    }

    public function testStripePaymentServiceValidatorInvalidAmount(): void {
        $stripe_validator = new StripePaymentServiceValidator();
        $this->assertFalse($stripe_validator->isFloat("wrong float"));
    }

    public function testStripePaymentServiceValidatorInvalidCardLength(): void {
        $stripe_validator = new StripePaymentServiceValidator();
        $this->assertFalse($stripe_validator->isValidCardLength("999999999999999999"));
    }

    public function testStripePaymentServiceValidatorInvalidCvcLength(): void {
        $stripe_validator = new StripePaymentServiceValidator();
        $this->assertFalse($stripe_validator->isValidCvcLength("4444"));
    }

    public function testStripePaymentServiceValidatorInvalidExpiryMonth(): void {
        $stripe_validator = new StripePaymentServiceValidator();
        $this->assertFalse($stripe_validator->isValidExpiryMonth(15));
    }

    public function testStripePaymentServiceValidatorInvalidExpiryYear(): void {
        $stripe_validator = new StripePaymentServiceValidator();
        $this->assertFalse($stripe_validator->isValidExpiryYear(2018));
    }

}
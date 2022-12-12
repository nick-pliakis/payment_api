<?php 

namespace Authenticators;

use Interfaces\Authenticator;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class PaymentAuthenticator implements Authenticator
{

    public function authenticate($token) {
        try {
            $decoded = JWT::decode($token, new Key($_ENV["JWT_SECRET"], 'HS256'));
        } catch (\DomainException $ex) {
            return false;
        }

        return $decoded->sub;
    }

}
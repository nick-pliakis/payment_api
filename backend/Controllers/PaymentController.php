<?php

namespace Controllers;

use Models\Merchant;
use Connectors\CurlConnection;
use Connectors\MysqlConnection;
use Interfaces\Authenticator;
use Transformers\ResponseTransformer;

use Factories\PaymentServiceProviderFactory;

class PaymentController
{

    private $authenticator;
    public $response;

    public function __construct(Authenticator $authenticator, ResponseTransformer $response) {
        $this->authenticator = $authenticator;
        $this->response = $response;
    }

    public function pay($data, $bearer_token) {
        $email = $this->authenticator->authenticate($bearer_token);

        $steve = new Merchant(MysqlConnection::getInstance());
        if (!$steve->getByEmail($email)) {
            $this->response->setPayload([], "Merchant not found", 400)->getResponse();
            exit();
        }

        $steve->setPsp(PaymentServiceProviderFactory::create($steve->getPspName(), CurlConnection::getInstance()));
        
        if (!isset($data["email"])) {
            $data["email"] = $steve->getEmail();
        }
        
        $result = $steve->getPsp()->makePayment($data);

        if (!$result["result"]) {
            $this->response->setPayload([], $result["message"], (isset($result["code"]) ? $result["code"] : 400))->getResponse();
        } else {
            $this->response->setPayload($result["data"], $result["message"])->getResponse();
        }
    }

}
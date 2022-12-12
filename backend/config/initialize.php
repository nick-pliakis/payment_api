<?php

use Connectors\CurlConnection;
use Connectors\MysqlConnection;
use Transformers\ResponseTransformer;

define("PROJECT_ROOT_PATH", __DIR__ . "/..");

require_once PROJECT_ROOT_PATH . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(PROJECT_ROOT_PATH);
$dotenv->load();

require_once PROJECT_ROOT_PATH . "/config/config.php";
require_once PROJECT_ROOT_PATH . "/config/database.php";

require_once PROJECT_ROOT_PATH . "/Interfaces/Authenticator.php";
require_once PROJECT_ROOT_PATH . "/Interfaces/DatabaseConnection.php";
require_once PROJECT_ROOT_PATH . "/Interfaces/HttpConnection.php";
require_once PROJECT_ROOT_PATH . "/Interfaces/PaymentServiceProvider.php";
require_once PROJECT_ROOT_PATH . "/Interfaces/Validator.php";

require_once PROJECT_ROOT_PATH . "/Models/Merchant.php";
require_once PROJECT_ROOT_PATH . "/Models/PinPaymentServiceProvider.php";
require_once PROJECT_ROOT_PATH . "/Models/StripePaymentServiceProvider.php";

require_once PROJECT_ROOT_PATH . "/Connectors/CurlConnection.php";
require_once PROJECT_ROOT_PATH . "/Connectors/MysqlConnection.php";

require_once PROJECT_ROOT_PATH . "/Validators/PaymentServiceValidator.php";
require_once PROJECT_ROOT_PATH . "/Validators/PinPaymentServiceValidator.php";
require_once PROJECT_ROOT_PATH . "/Validators/StripePaymentServiceValidator.php";

require_once PROJECT_ROOT_PATH . "/Factories/ControllerFactory.php";
require_once PROJECT_ROOT_PATH . "/Factories/PaymentServiceProviderFactory.php";

require_once PROJECT_ROOT_PATH . "/Authenticators/PaymentAuthenticator.php";

require_once PROJECT_ROOT_PATH . "/Controllers/PaymentController.php";

require_once PROJECT_ROOT_PATH . "/Transformers/ResponseTransformer.php";

$db_handle = MysqlConnection::getInstance();
$curl_handle = CurlConnection::getInstance();
$response = new ResponseTransformer();

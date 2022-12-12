<?php

use Factories\ControllerFactory;

require __DIR__ . "/config/initialize.php";

$url_array = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
array_shift($url_array);

if (!isset($url_array[0]) | !isset($url_array[1])) {
    http_response_code(404);
    exit();
}

$controller = ControllerFactory::create($url_array[0], $response);
$method = $url_array[1];

if ($controller === null || !method_exists($controller, $method)) {
    $response->setPayload([], "Resource does not exist!", 404)->getResponse();
    exit();
}

if (!isset($_SERVER["HTTP_BEARER"])) {
    $response->setPayload([], "You are not authorized to access this resource!", 401)->getResponse();
    exit();
}

$data = empty($_POST) ? json_decode(file_get_contents('php://input'), true) : $_POST;

$controller->$method($data, $_SERVER["HTTP_BEARER"]);


//DETERMINE SOME TESTS
//WRITE SOME TESTS
//LEVERAGE SERVICES TO ADD ADDITIONAL LAYER
//ADD LOGGING OF TRANSACTIONS


// X INSTALL PHPUNIT 
// X WRITE THE STRIPE VALIDATOR
// X MAKE IT TAKE EMAIL FROM MERCHANT
// X CHECK IF ENDPOINT IS CORRECT, RETURN 404 IF NOT
// X MOVE EVERYTHING TO CONTROLLER
// X AUTHENTICATE USER
// X MAKE CONTROLLER WORK PROPERLY
// X ADD CHECK FUNCTIONS IN THE VALIDATORS
// X ADD PROPER RESPONSES
// X ADD RESPONSE BASED ON ERROR RESPONSES FROM APIS

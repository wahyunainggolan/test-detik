<?php
require 'Controller/TransactionController.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];

doAction($requestMethod);

function doAction(string $requestMethod) {
    $transactionController = new TransactionController();
    switch ($requestMethod) {
        case 'GET':
            if (empty($_GET["references_id"])) {
                $response = $transactionController->getAllData();
            } else {
                $response = $transactionController->findData([
                    "references_id" => $_GET["references_id"],
                    "merchant_id" => $_GET["merchant_id"],
                ]);
            };
            break;
        case 'POST':
            $response = $transactionController->create($_POST);
            break;
        default:
            $response = notFoundResponse();
            break;
        }
        
        echo $response;
}

function notFoundResponse($result): string
{
    return json_encode([
        'error' => true,
        'message' => 'Not found page'
    ]);
}
?>
<?php
require 'Services/TransactionServices.php';

class TransactionController {

    private $transactionServices;

    public function __construct()
    {
        $this->transactionServices = new TransactionServices();
    }

    public function getAllData(): string
    {
        $result = $this->transactionServices->getAllData();

        return $this->response($result);
    }

    public function findData(array $params): string
    {
        $result = $this->transactionServices->findData($params);

        return $this->response($result);
    }

    public function create(array $params): string
    {
        $result = $this->transactionServices->create($params);

        return $this->response($result);
    }

    private function response($result): string
    {
        return json_encode([
            'error' => false,
            'message' => 'Get Data Successfully',
            'data' => $result
        ]);
    }
}
?>
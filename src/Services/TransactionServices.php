<?php

require "config.php";
require 'Models/Transactions.php';

class TransactionServices {

    private $model;

    public function __construct()
    {
        $database = new Config();
        $this->model = new Transactions(
            $database->openConnection()
        );
    }

    function getAllData(): ?array
    {
        $results = $this->model->getAll('transactions')->fetch_all(MYSQLI_ASSOC);

        return $results;
    }

    function findData(array $params): ?array
    {
        $results = $this->model->findData('transactions', $params)->fetch_array(MYSQLI_ASSOC);
        if (empty($results)) return null;

        return [
            "references_id" => $results['references_id'],
            "invoice_id" => $results['invoice_id'],
            "status" => Transactions::LIST_STATUS[$results['status']]
        ];
    }

    function create(array $params): ?array
    {
        if ($params['payment_type'] === 'virtual_acount') {
            $params['number_va'] = rand();
        } 
        
        $results = $this->model->create('transactions', $params)->fetch_array(MYSQLI_ASSOC);

        return [
            "references_id" => $results['references_id'],
            "number_va" => $results['number_va'] ?? "-",
            "status" => Transactions::LIST_STATUS[$results['status']]
        ];
    }

    function updateStatus(int $referencesId, string $status)
    {
        $listStatus = ["Pending", "Paid", "Failed",  "Expired"];

        if (!in_array($status, $listStatus)) {
            die("error status, Status must be Pending, Paid, Failed or Expired");
        }

        $getData = $this->model->findDataByRefId('transactions', $referencesId)->fetch_array(MYSQLI_ASSOC);

        if (empty($getData)) {
            die("error id, Data Not found in db");
        }

        return $this->model->updateStatus('transactions', $status, $referencesId);
    }
}

?>
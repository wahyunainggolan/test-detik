<?php
require 'Services/TransactionServices.php';

if (count($argv) != 3) {
    die("error, format file : php transaction-cli.php {references_id} {status}");
}

$referencesId = $argv[1];
$status = $argv[2];
$transactionServices = new TransactionServices();
$result = $transactionServices->updateStatus($referencesId, $status);

if ($result) {
    echo "success update status";
} else {
    echo "error update status";
}

?>
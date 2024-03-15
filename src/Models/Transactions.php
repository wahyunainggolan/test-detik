<?php 
class Transactions {

    protected $db;
    CONST PENDING = 1;
    CONST PAID = 2;
    CONST FAILED = 3;
    CONST EXPIRED = 4;

    const LIST_STATUS = [
        SELF::PENDING => "Pending",
        SELF::PAID => "Paid",
        SELF::FAILED => "Failed",
        SELF::EXPIRED => "Expired"
    ];

    const LIST_STATUS_VALUE = [
        "Pending" => SELF::PENDING,
        "Paid" => SELF::PAID,
        "Failed" => SELF::FAILED,
        "Expired" => SELF::EXPIRED 
    ];

    function __construct($db){
        $this->db = $db;
    }

    function getAll(string $table)
    {
        return $this->db->query("SELECT * FROM $table");
    }

    function findData(string $table, array $params)
    {
        $refId = $params['references_id'];
        $merchantId = $params['merchant_id'];

        return $this->db->query("SELECT * FROM $table WHERE references_id = $refId AND merchant_id = '$merchantId' ");
    }

    function create(string $table, array $paramsArr)
    {
        $key = array_keys($paramsArr);
        $val = array_values($paramsArr);

        $query = "INSERT INTO $table (" . implode(', ', $key) . ") "
            . "VALUES ('" . implode("', '", $val) . "')";

        $row = $this->db->prepare($query);
        $row->execute();

        return $this->db->query("SELECT * FROM $table ORDER BY references_id DESC");
    }

    function updateStatus(string $tabel, string $status, int $id)
    {
        $status = self::LIST_STATUS_VALUE[$status];
        $query = "UPDATE $table SET status = $status WHERE references_id = $id";
        $row = $this->db->prepare($query);
        
        return $row->execute();
    }

    function findDataByRefId(string $table, array $refId)
    {
        return $this->db->query("SELECT * FROM $table WHERE references_id = $refId");
    }
}
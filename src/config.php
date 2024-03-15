<?php

Class Config {
    private $server = 'mysql_db';
    private $username = 'root';
    private $password = "root";
    private $dbName = "detik";
    protected $con;

    public function openConnection()
    {
        try {
            $this->con = new mysqli(
                $this->server,
                $this->username,
                $this->password,
                $this->dbName
            );

            $sql = "CREATE TABLE transactions (
                    references_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    invoice_id VARCHAR(100) NOT NULL,
                    item_name VARCHAR(100) NOT NULL,
                    amount BIGINT(100),
                    payment_type VARCHAR(100) NOT NULL,
                    customer_name VARCHAR(100) NULL,
                    merchant_id VARCHAR(100) NOT NULL,
                    number_va BIGINT(100) NULL,
                    status INT(1) DEFAULT 1 -- 1=>Pending; 2=>Paid; 3=>Failed; 4=>Expired
                )";

            echo $this->con->query($sql);

            if ($this->con->query($sql) === TRUE) {
              echo "Table transactions created successfully";
            }
        
            return $this->con;
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    public function closeConnection()
    {
        $this->con = null;
    }

}




    // }
?>
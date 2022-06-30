<?php

class keukenType {

    private $conncetion;

    public function __construct ($connection) {
        $this->connection = $connection;
    }

    public function selectKeukenType ($keukenType_id) {
        $sql= "select * from keukenType where id= $keukenType_id";

        $result = mysqli_query($this->connection, $sql);
        $keukenType = mysqli_fetch_array($result, MYSQLI_ASSOC);

        return($keukenType);
    }

}
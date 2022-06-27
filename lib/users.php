<?php

class users {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function selecteerUser($users_id) {
        
        $sql= "select * from artikel where id = $users_id";

        $result = mysqli_query ($this->connection, $sql);
        $users = mysqli_fetch_array ($result, MYSQLI_ASSOC);

        echo 'Connected successfully';

        return ($users);
        
       
    }
    
}
<?php

class users {
    private $connection;

    public function__construct($connection){
        this->connection = $connection;
    }

    public function selecteerUser($users_id) {
        
        $sql= "SELECT * FROM `users` where id = $users_id";

        $result = mysqli_query ($this->connection, $sql);
        $artikel = mysqli_fetch_array ($result, MYSQLI_ASSOC);

        return ($users);
        
        echo 'Connected successfully';
    }
    
}
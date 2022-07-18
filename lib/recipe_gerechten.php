<?php

class recipe {
    private $connection;


    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function selectgerecht($gerecht_id = null) {
        // $extrasql= is_null($gerecht_id)?"":" where id = $id";
        $sql="SELECT * FROM gerecht";
        $result=mysqli_query($this->connection, $sql);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $recipe[] = $row;
        }
        
        return ($recipe);
    
    }
}



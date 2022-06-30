<?php

class ingredient {

    private $connection;
    private $art;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->art = new artikel($connection);   
    }

    private function selecteerArtikel($artikel_id) {
        $artikel = $this->art->selecteerArtikel($artikel_id);
        return($artikel);
    }

    public function selecteerIngredient ($gerecht_id) {
        $sql= "SELECT * FROM ingredient where gerecht_id = $gerecht_id";
    
        $result = mysqli_query($this->connection, $sql);
        while($ingredient = mysqli_fetch_array($result)) {
            echo "<pre>";
            $artikel = $this->selecteerArtikel($ingredient["artikel_id"]);
            echo "--------------------------------------------------------";
            var_dump($artikel);

        }       
    
        return([]);
    }

}

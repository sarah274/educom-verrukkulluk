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

        $return  = [];
    
        $result = mysqli_query($this->connection, $sql);
        while($ingredient = mysqli_fetch_array($result)) {

            $artikel = $this->selecteerArtikel($ingredient["artikel_id"]);
          
            $return[] = [
                "ingredient_id" => $ingredient["id"],
                "artikel_id" => $artikel["id"],
                "artikel_naam" => $artikel["naam"],
                "artikel_omschrijving" => $artikel["omschrijving"],
                "artikel_prijs" => $artikel["prijs"],
                "artikel_cal" => $artikel["calorie"],
                "artikel_eh" => $artikel["eenheid"],
                "artikel_verpak" => $artikel["verpakking"],
                "aantal" => $ingredient["aantal"],
                "gerecht-id" =>$ingredient ["gerecht_id"]
            ];

        }      
        
        
        return($return);
    
    

    }

}

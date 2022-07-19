<?php

class Boodschappenlijst {

    private $connection;
    


    public function __construct($connection) {
        $this->connection = $connection;
       
    }

    private function selecteerIngredient ($gerecht_id) {
        $ingredienten= $this->ingredient->selecteerIngredient($gerecht_id);
        return ($ingredient);
    }

    private function ArtikelOpLijst ($artikel_id, $user_id) {

        $sql= "SELECT * FROM boodschappenlijst where id = $boodschappenlijst_id";

        $boodschappen= $this->OphalenBoodschappen($user_id["artikel_id"=="artikel_id"]);

        foreach ($boodschappen as $boodschap) {
            if ($boodschappen) {
                return ($boodschap);
            }else{
                return (false);
            }
        }
    }

    private function ArtikelToevoegen ($ingredient, $user_id) {

        $sql= "SELECT * FROM boodschappenlijst";

        // $aantal = 0;
        // if ($artikel_id && $aantal > 0) {
        //     $toevoegen = $artikel_id = $aantal;
        // }
        // return ($toevoegen);
    }


    private function ArtikelBijwerken ($boodschappenlijst) {

        $sql= "UPDATE `boodschappenlijst` SET `aantal` = '3' WHERE `boodschappenlijst`.`id` = 6";
        mysqli_query ($db, $sql);

        // $aantal = 0;
        // if ($artikel_id && $aantal > 0) {
        //     $bijwerken = $artikel_id += $aantal;
        // }
        // return ($bijwerken);
    }

    private function OphalenBoodschappen ($user_id){
        $sql= "SELECT * FROM boodschappenlijst where id = $user_id";
        $result = mysqli_query($this->connection, $sql);

        return ($result);
    }

    public function boodschappenToevoegen ($gerecht_id, $user_id) {
        // $sql= "SELECT * FROM ingredient where gerecht_id = $gerecht_id and user_id = $user_id";

        $ingredienten= $this->ingredient->selecteerIngredient($gerecht_id);
        foreach ($ingredienten as $ingredient) {

            $boodschappenlijst= ($this-> $ArtikelOpLijst($ingredient["$artikel_id, $user_id"]))

            if ($boodschappenlijst)
                {
                    $this->ArtikelBijwerken($boodschappenljst);
                } else {
                     $this->ArtikelToevoegen($ingredient, $user_id);
                }
                end ($ArtikelOpLijst);
                return ($boodschappenlijst);
        }
    }
}
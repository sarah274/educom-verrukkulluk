<?php

class gerecht {
    private $connection;
    private $user;
    private $ingredient;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->user = new user ($connection);
        $this->ingredient = new ingredient ($connection);
    }

    private function selecteerUser($user_id) {
        $user = $this->user->selecteerUser($user_id);
        return ($user);
    }

    private function selecteerIngredient ($ingredient) {
        $ingredient= $this->ingredient->selecteerIngredient($ingredient);
        return ($ingredient);
    }
   
    public function selectgerecht ($gerecht_id) {
        $sql = "SELECT * FROM gerecht WHERE id = $gerecht_id";

        $return= [];

        $result=mysqli_query($this->connection, $sql);

       while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $user = $this ->selecteerUser($row ["user_id"]);
            $ingredient = $this ->selecteerIngredient($row ["ingredient_id"]);
        
        
            $recipe[]=["gerecht" => $row];


                
            //     "gerecht" => $gerecht ["id"],
            //     "keuken" => $gerecht ["keuken_id"],
            //     "type"=> $gerecht ["type_id"],
            //     "user"=>$gerecht ["user_id"],
            //     "datum" => $gerecht ["datum"],
            //     "titel"=>$gerecht ["titel"],
            //     "korte"=>$gerecht ["korte_omschrijving"],
            //     "lang"=>$gerecht ["lange_omschrijving"],
            //     "foto"=>$gerecht ["afbeelding"]
                    
            // ];
        }
        
        return ($recipe);
    }
}

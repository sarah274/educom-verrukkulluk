<?php

class gerecht {
    private $connection;
    private $user;
    private $ingredient;
    private $calorie;

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


    private function calcCalories ($ingredient) {
       
    $ingredientInfo = array();
    $sum= 0;

        foreach ($ingredientInfo as $sum) {
           $sum += $artikel_id ["calorie"] * ($ingredient ["hoeveelheid"] / $artikel_id ["verpakking"]);
        }
        return ($sum);
    }


   
    public function selectgerecht ($gerecht_id) {
        $sql = "SELECT * FROM gerecht WHERE id = $gerecht_id";

        $result=mysqli_query($this->connection, $sql);

       while ($gerecht = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $user = $this ->selecteerUser($gerecht ["user_id"]);
            $ingredient = $this ->selecteerIngredient($gerecht["gerecht_id"]);
            $ingredientInfo = $this ->calcCalories($ingredient)["calorie"];

                $recipe[]= [
                
                "gerecht" => $gerecht ["id"],
                "keuken" => $gerecht ["keuken_id"],
                "type"=> $gerecht ["type_id"], 
                "user"=>$gerecht ["user_id"],
                "datum" => $gerecht ["datum"],
                "titel"=>$gerecht ["titel"],
                "korte"=>$gerecht ["korte_omschrijving"],
                "lang"=>$gerecht ["lange_omschrijving"],
                "foto"=>$gerecht ["afbeelding"]
                    
            ];
        }
        
        return ($recipe);
    }
}

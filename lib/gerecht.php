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


    private function calcCalories ($ingredienten) {
       
        $sum= 0;

        foreach ($ingredienten as $ingredient) {   
            
                $sum += $ingredient[0]["artikel_cal"] * ($ingredient [0]["aantal"] / $ingredient [0]["artikel_verpak"]);
            
        }
        return ($sum);
    }


   
    public function selectgerecht ($gerecht_id) {
        $sql = "SELECT * FROM gerecht WHERE id = $gerecht_id";

        $result=mysqli_query($this->connection, $sql);

       while ($gerecht = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $user = $this->selecteerUser($gerecht ["user_id"]);
            $ingredienten = $this->selecteerIngredient($gerecht["gerecht_id"]);
            $calorieen = $this->calcCalories($ingredienten);

                $recipe[]= [
                
                "gerecht" => $gerecht ["id"],
                "keuken" => $gerecht ["keuken_id"],
                "type"=> $gerecht ["type_id"], 
                "user"=>$gerecht ["user_id"],
                "datum" => $gerecht ["datum"],
                "titel"=>$gerecht ["titel"],
                "korte"=>$gerecht ["korte_omschrijving"],
                "lang"=>$gerecht ["lange_omschrijving"],
                "foto"=>$gerecht ["afbeelding"],
                "ingredienten"=>$ingredienten,
                "calorieen"=>$calorieen
                    
            ];
        }
        
        return ($recipe);
    }
}

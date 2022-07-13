<?php

class gerecht {
    private $connection;
    private $user;
    private $ingredient;
    private $calorie;
    private $price;

    public function __construct($connection) {
        $this->connection = $connection;
        $this->user = new user ($connection);
        $this->ingredient = new ingredient ($connection);
    }


    private function selecteerUser($user_id) {
        $user = $this->user->selecteerUser($user_id);
        return ($user);
    }



    private function selecteerIngredient ($gerecht_id) {
        $ingredient= $this->ingredient->selecteerIngredient($gerecht_id);
        return ($ingredient);
    }


    private function calcCalories ($ingredienten) {
        $calorie= 0;
        foreach ($ingredienten as $ingredient) {   
            
                $calorie += $ingredient["artikel_cal"] * ($ingredient ["aantal"] / $ingredient ["artikel_verpak"]);   
        }
        return ($calorie);
    }



    private function calcPrice ($ingredienten) {
        $price= 0;
        foreach ($ingredienten as $ingredient) {

            $price += $ingredient ["artikel_prijs"];
        }
        return ($price);
    }


    // private function selectgerechtInfo ($gerecht_id, $record_type) {
    //     $gerecht_info= $this->gerecht_info->selectgerechtInfo($gerecht_id, $record_type);
    //     return ($gerecht_info);
    // }


    private function selectRating ($gerechten_id, $record_type) {
        
            $rating= 0;

            foreach ($gerechten_id as $gerecht_id) {

                $rating +=  ($gerecht_id ["nummers"]) / count ($gerecht_id ["nummers"]);
             }
            

        return ($rating);
    }


   
    public function selectgerecht ($gerecht_id) {
        $sql = "SELECT * FROM gerecht WHERE id = $gerecht_id";

        $result=mysqli_query($this->connection, $sql);

       while ($gerecht = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $user = $this->selecteerUser($gerecht ["user_id"]);
            $ingredienten = $this->selecteerIngredient($gerecht_id);
            

            $calorieen = $this->calcCalories($ingredienten);
            $price= $this->calcPrice($ingredienten);

            // $gerecht_info = $this->selectgerechtInfo($gerecht_id, $record_type);
          
          
            if ($record_type == "W"){
                $rating = $this->selectRating($gerechten_id ["nummers"]);
            }
            


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
                "calorieen"=>$calorieen,
                "price" => $price,
                "rating"=>$rating
                
            ];
            
        }
        return ($recipe);
    }
}

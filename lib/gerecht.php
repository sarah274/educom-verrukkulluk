<?php

class gerecht {
    private $connection;
    private $user;
    private $ingredient;
    private $gerecht_info;
    private $keukenType;
    private $calorie;
    private $price;
    private $rating;
   

    public function __construct($connection) {
        $this->connection = $connection;
        $this->user = new user ($connection);
        $this->ingredient = new ingredient ($connection);
        $this->gerecht_info= new gerecht_info ($connection);
        $this->keukenType= new keukenType ($connection);
    }


    private function selecteerUser($user_id) {
        $user = $this->user->selecteerUser($user_id);
        return ($user);
    }


    private function selecteerIngredient ($gerecht_id) {
        $ingredient= $this->ingredient->selecteerIngredient($gerecht_id);
        return ($ingredient);
    }


    private function selectgerechtInfo ($gerecht_id, $record_type) {
        $gerecht_info= $this->gerecht_info->selectgerechtInfo ($gerecht_id, $record_type);
        return ($gerecht_info);
    }


    private function selectKeukenType ($keukenType_id) {
        $keukenType= $this->keukenType->selectKeukenType ($keukenType_id);
        return ($keukenType);
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


    private function selectRating ($gerecht_id) {
        $rating= $this->selectgerechtInfo($gerecht_id, "W");
    
        return ($rating);
    }

 
    private function calcRating ($ratings) {
        
        $total= 0;
        $aantal= count($ratings);
       
        if ($aantal == 0) return (0);

        foreach ($ratings as $rating) {

            $total +=  $rating["nummeriekveld"];
        }
        $gemiddelde_rating = $total / $aantal;
            
        return ($gemiddelde_rating);
    }


    private function selectOpmerking ($gerecht_id) {
        $opmerking= $this->selectgerechtInfo($gerecht_id, "O");
        return ($opmerking);
    }


    private function selectSteps ($gerecht_id) {
        $bereidngswijze= $this->selectgerechtInfo($gerecht_id, "B");
        return ($bereidngswijze);
    }

   
    public function selectgerecht ($gerecht_id = null) {
        $sql = "SELECT * FROM gerecht";
        if(!is_null($gerecht_id)) {
            $sql .= " WHERE id = $gerecht_id";
        }

        $result=mysqli_query($this->connection, $sql);

       while ($gerecht = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $user = $this->selecteerUser($gerecht ["user_id"]);
            $ingredienten = $this->selecteerIngredient($gerecht["id"]);
            $gerecht_info = $this->selectgerechtInfo($gerecht_id, "W", "O", "B");
            $keuken= $this->selectKeukenType($gerecht ["keuken_id"]);
            $type=$this->selectKeukenType($gerecht ["type_id"]);

            $calorieen = $this->calcCalories($ingredienten);
            $price= $this->calcPrice($ingredienten);

            $ratings = $this->selectRating($gerecht["id"]);
            $gemiddelde_rating= $this->calcRating ($ratings);

            $opmerking= $this->selectOpmerking($gerecht["id"]);
            $bereidngswijze= $this->selectSteps($gerecht["id"]);

           
                $recipe[]= [
                
                "gerecht" => $gerecht ["id"],
                "user" => $user,
                "datum" => $gerecht ["datum"],
                "titel"=>$gerecht ["titel"],
                "korte"=>$gerecht ["korte_omschrijving"],
                "lang"=>$gerecht ["lange_omschrijving"],
                "foto"=>$gerecht ["afbeelding"],
                "ingredienten"=>$ingredienten,
                "calorieen"=>$calorieen,
                "price" => $price,
                "ratings"=>$ratings,
                "gemiddelde_rating" => $gemiddelde_rating,
                "opmerking"=>$opmerking,
                "bereidngswijze" => $bereidngswijze,
                "keuken" => $keuken ["omschrijving"],
                "type"=> $type ["omschrijving"]
          
            ];
            
        }
        return ($recipe);
    }
}

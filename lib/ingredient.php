<?php

class ingredient {

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function selecteerIngredient ($ingredient_id) {
        $sql= "SELECT * FROM `gerecht`
         JOIN ingredient ON gerecht_id = ingredient.gerecht_id

         JOIN artikel ON ingredient.artikel_id = artikel_id";

        $result = mysqli_query($this->connection, $sql);
        $ingredient = mysqli_fetch_array($result, MYSQLI_ASSOC);
       
        return($ingredient);
    }
}
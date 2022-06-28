<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once ("lib/ingredient.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$user = new user($db->getConnection());
$ingredient = new ingredient ($db->getConnection());


/// VERWERK 
$data = $art->selecteerArtikel(8);
$data2 = $user->selecteerUser(8);
$ing = $ingredient->selecteerIngredient(8);

/// RETURN
var_dump($data);
var_dump($data2);
var_dump ($ing);
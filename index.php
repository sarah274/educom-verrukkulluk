<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
// require_once ("lib/ingredient.php");
require_once ("lib/keukenType.php");
// require_once ("lib/gerecht-info.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$user = new user($db->getConnection());
// $ingredient = new ingredient ($db->getConnection());
$KT= new keukenType($db->getConnection());



/// VERWERK 
$data = $art->selecteerArtikel(1);
$data2 = $user->selecteerUser(3);
// $ing = $ingredient->selecteerIngredient(8);
$KT = $KT->selectKeukenType(1);
echo "<pre>";

/// RETURN
var_dump($data);
var_dump($data2);
// var_dump ($ing);
var_dump ($KT);

<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/user.php");
require_once ("lib/ingredient.php");
require_once ("lib/keukenType.php");
require_once ("lib/gerecht-info.php");
require_once ("lib/gerecht.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$user = new user($db->getConnection());
$ingredient = new ingredient ($db->getConnection());
$KT= new keukenType($db->getConnection());
$gi= new gerecht_info ($db->getConnection());
$gerecht = new gerecht ($db->getConnection());



/// VERWERK 
// $data = $art->selecteerArtikel(1);
// $data2 = $user->selecteerUser(3);
// $ing = $ingredient->selecteerIngredient(4);
// $KT = $KT->selectKeukenType(1);
// $opmerking = $gi->selectgerechtInfo(2,"O");
// $favorite = $gi->selectgerechtInfo(2,"F");
// $bereidngswijze= $gi->selectgerechtInfo(2,"B");
// $waardering = $gi->selectgerechtInfo(2,"W");
// $ingredient = $ingredient->selecteerIngredient(2);
$gerecht = $gerecht->selectgerecht(2);



echo "<pre>";

/// RETURN
// var_dump($data);
//var_dump($data2);
 //var_dump ($ing);
// var_dump ($KT);
// var_dump ($opmerking);
// var_dump ($favorite);
// var_dump ($bereidngswijze);
// var_dump ($waardering);
// var_dump ($ingredient);
var_dump ($gerecht);

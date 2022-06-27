<?php

require_once("lib/database.php");
require_once("lib/artikel.php");
require_once("lib/users.php");

/// INIT
$db = new database();
$art = new artikel($db->getConnection());
$users = new users($db->getConnection());


/// VERWERK 
$data = $art->selecteerArtikel(8);
$data2 = $users->selecteerUser(8);

/// RETURN
var_dump($data);
var_dump($data2);
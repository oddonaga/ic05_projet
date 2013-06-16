<?php

session_start();


$_SESSION["id_get"]=0;

$array = file('./users_id_200.csv');

$users=array();
foreach ($array as $key => $value) {
	$tab=explode(',', $value);
	$users[]=$tab[0];
}

$_SESSION['users']=$users;

print_r($_SESSION);

?>
<?php

session_start();



$fp = fopen('tweets_and_names_200.csv', 'a');

$array = file('./users_id_200.csv');
$users=array();
foreach ($array as $key => $value) {
	$tab=explode(',', $value);
	$id=intval($tab[0]);
	$name=$tab[1];
	$users[$id]=$name;
}
// print_r($users);


$array = file('./users_followers_200.csv');

foreach ($array as $key => $value) {
	$tab=explode(',', $value);
	$id=intval($tab[0]);
	$followers=$tab[1];
	$username=$users[$id];
	if(array_key_exists($id,$users)){
		fwrite($fp, $id.','.$username.','.$followers);
	}
}


?>
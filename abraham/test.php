<?php

session_start();




$data_a = file('../data.csv');
$names_a = file('./tweets_and_names_200.csv');
$fp = fopen('data_all.csv', 'a');

$names=array();
foreach ($names_a as $key => $value) {
	$tab=explode(',', $value);
	$id=intval($tab[0]);
	$name=$tab[1];
	$followers=$tab[2];
	$names[$id]=array('name' => $name, 'followers' => $followers);
}

$data=array();
foreach ($data_a as $key => $value) {
	$tab=explode(',', $value);
	$id=intval($tab[0]);
	$time=$tab[1];
	$choix=str_replace("\n", "", $tab[2]);
	$data[$id]=array('time' => $time, 'choix' => $choix);
}

foreach ($names as $key => $value) {
	$id=$key;
	$name=$value['name'];
	$followers=$value['followers'];

	$time=$data[$id]['time'];
	$choix=$data[$id]['choix'];

	// echo '<br>'.$id.' : '.$followers;

	fwrite($fp, $id.','.$name.','.$time.','.$choix.','.$followers);
}


// $array = file('./users_followers_200.csv');

// foreach ($array as $key => $value) {
// 	$tab=explode(',', $value);
// 	$id=intval($tab[0]);
// 	$followers=$tab[1];
// 	$username=$users[$id];
// 	if(array_key_exists($id,$users)){
// 		fwrite($fp, $id.','.$username.','.$followers);
// 	}
// }


?>
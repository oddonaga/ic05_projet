<?php

session_start();




$data_a = file('../data.csv');
$names_a = file('./tweets_and_names_200.csv');
$fp = fopen('data_all2.csv', 'a');

$names=array();
$est_follow=array();
foreach ($names_a as $key => $value) {
	$tab=explode(',', $value);
	$id=intval($tab[0]);
	$name=$tab[1];
	$followers=$tab[2];
	$names[$id]=array('name' => $name, 'followers' => $followers);
	$est_follow[$id]=0;
}

foreach ($names as $key => $value) {
	$followers=$value["followers"];
	$followers=str_replace("\n", "", $value['followers']);
	$followers_a=explode(";",$followers);

	foreach ($followers_a as $key2 => $value2) {
		if(array_key_exists($value2, $names)){
			$value2=intval($value2);
			$followers_a2[]=$value2;
			$est_follow[$value2]=1;
		}
		else{
			if(!in_array($value2, $test)){
				$test[]=$value2;
			}
		}
	}
}

$data=array();
foreach ($data_a as $key => $value) {
	$tab=explode(',', $value);
	$id=intval($tab[0]);
	$time=$tab[1];
	$choix=str_replace("\n", "", $tab[2]);
	$data[$id]=array('time' => $time, 'choix' => $choix);
}

$test=array();

foreach ($names as $key => $value) {
	$id=$key;
	$name=$value['name'];
	$followers=str_replace("\n", "", $value['followers']);
	$followers_a=explode(";",$followers);

	$followers_a2=array();
	foreach ($followers_a as $key2 => $value2) {
		if(array_key_exists($value2, $names)){
			$followers_a2[]=$names[$value2]['name'];
		}
		else{
			if(!in_array($value2, $test)){
				$test[]=$value2;
			}
		}
	}

	$time=$data[$id]['time'];
	$choix=$data[$id]['choix'];

	// echo '<br>'.$id.' : '.$followers;

	if(count($followers_a)==1 and $followers=="" and $est_follow[$id]==0){
		echo $id." non écrit<br>";
		$i++;
	}
		
	else fwrite($fp, $id.','.$name.','.$time.','.$choix.','.implode(";",$followers_a2)."\n");
	 
}

echo 'i='.$i;

// print_r($names);

// echo '<br><br>count ='.count($test).'<br>';
// print_r($test);


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
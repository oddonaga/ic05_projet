<?php


$array = file('data.csv');
$fp = fopen('data2.csv', 'a');

foreach ($array as $ligne) {
	$ligne_a=explode(',', $ligne);
	echo $ligne_a[0].','.$ligne_a[1];
	$date=date_create($ligne_a[2].','.$ligne_a[3]);
	echo ','.$date->getTimestamp()"<br>";
	fwrite($fp, $ligne_a[0].','.$ligne_a[1].','.$date->getTimestamp()."\n");
}



?>
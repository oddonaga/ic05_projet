<?php

echo "<meta http-equiv=\"Content-Type\" content=\"text/HTML; charset=utf-8\" />";


$array = file('users_id_500.csv');
$users=array();


for($i=0;$i<count($array);$i++) {
	// echo '<br>Je lis : '.$array[$i];
	$array2=explode(',',$array[$i]);
	$id=intval($array2[0]);
	if(!in_array($id, $users)){
		$users[]=$id;
	}
	else echo '<br>id='.$id.' dupliqué';
}

echo '<br>Fin du test';

fclose($fp);


?>
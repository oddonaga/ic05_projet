<?php

session_start();

require_once('lib/twitteroauth.php');
require_once('config.php');



$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);


if($connection)
	echo "connection worked<br/>";
	

$array = file('../data2.csv');
$fp = fopen('users.csv', 'a');



for($i=62;$i<count($array);$i++) {
	$ligne=$array[$i];
	$ligne_a=explode(',', $ligne);
	$id=$ligne_a[0];
	echo $id.',';
	fwrite($fp, $id.',');

	// username
	$parameters = array('user_id' => $id);
	$result = $connection->get('users/show', $parameters);

	foreach ($result as $key => $value) {
		if($key=="screen_name"){
			echo $value.',';
			fwrite($fp, $value.',');
		}
	}

	// Followers
	$parameters = array('user_id' => $id, 'count' =>5000);
	$followers = $connection->get('followers/ids', $parameters);
	$tab=array();
	foreach ($followers as $key => $value) {
		if($key=="errors"){
			echo '<br>Error : ';
			print_r($value);
			return;
		}
		elseif($key=="ids"){
			foreach ($value as $follower) {
				if(in_array($follower, $_SESSION["users"])){
						$tab[]=$follower;
				}
			}
		}
	}
	echo implode(';', $tab)."<br>";
	fwrite($fp, implode(';', $tab)."\n");

	// var_dump($result);

	$i++;	
}


fclose($fp);



?>
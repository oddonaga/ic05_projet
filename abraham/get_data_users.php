<?php

session_start();

require_once('lib/twitteroauth.php');
require_once('config.php');



$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);


if($connection)
	echo "connection worked<br/>";
	

$array = file('users_id_500.csv');
$fp = fopen('users_followers_500.csv', 'a');



for($i=25;$i<100;$i++) {

	$ligne=$array[$i];
	$ligne_a=explode(',', $ligne);
	$id=$ligne_a[0];
	$username=$ligne_a[1];
	$nbreFollowers=intval($ligne[2]);

	echo 'id='.$id.', followers => ';
	// fwrite($fp, $id.',');

	// Followers
	$parameters = array('user_id' => $id, 'count' => 5000);
	$followers = $connection->get('followers/ids', $parameters);

	// print_r($followers);
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
	fwrite($fp, $id.','.implode(';', $tab)."\n");

	// var_dump($result);

	// $i++;	
}


fclose($fp);



?>
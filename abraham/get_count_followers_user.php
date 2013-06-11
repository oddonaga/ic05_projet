<?php

session_start();

require_once('lib/twitteroauth.php');
require_once('config.php');



$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);


if($connection)
	echo "connection worked<br/>";
	

$array = file('users_id.csv');
$fp = fopen('users_id_500.csv', 'a');



for($i=0;$i<4000;$i++) {
	$id=intval($array[$i]);
	echo 'id='.$id;

	// username
	$parameters = array('user_id' => $id);
	$result = $connection->get('users/show', $parameters);
	
	foreach ($result as $key => $value) {
		if($key=="followers_count"){
			echo ' followers_count='.$value;
			if($value>500){
				fwrite($fp, $id.','.$value."\n");
			}
		}
	}

	echo '<br>';
}

fclose($fp);


?>
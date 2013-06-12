<?php

session_start();

require_once('lib/twitteroauth.php');
require_once('config.php');



$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);


if($connection)
	echo "connection worked<br/>";
	

$array = file('users_id.csv');
$fp = fopen('users_id_500.csv', 'a');



for($i=1797;$i<1900;$i++) {
	$id=intval($array[$i]);
	echo 'i='.$i.', id='.$id;

	// username
	$parameters = array('user_id' => $id);
	$result = $connection->get('users/show', $parameters);
	
	foreach ($result as $key => $value) {
		if($key=="errors"){
			echo '<br>';
			print_r($value);
			foreach ($value as $key2 => $value2) {
				if(is_array($value2))
					foreach ($value as $key3 => $value3) {
						if($key3=="code" and ($value3=="88" or $value3=88))
							return;
					}
				if($key2=="code" and ($value2=="88" or $value2=88))
					return;
			}
		}

		if($key=="screen_name"){
			$name=$value;
		}
		else if($key=="followers_count"){
			echo ' followers_count='.$value;
			if($value>500){
				fwrite($fp, $id.','.$name.','.$value."\n");
			}
		}
	}

	echo '<br>';
}

fclose($fp);


?>
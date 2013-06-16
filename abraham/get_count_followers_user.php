<?php

session_start();

header ("Refresh: 300;URL=get_count_followers_user.php");

require_once('lib/twitteroauth.php');
require_once('config.php');

echo "<meta http-equiv=\"Content-Type\" content=\"text/HTML; charset=utf-8\" />";





$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);


if($connection)
	echo "connection worked<br/>";
	

$array = file('users_id.csv');
$fp = fopen('users_id_200.csv', 'a');


$begin_id=intval($_SESSION["id_get"]);
echo 'Je reprends à '.$begin_id.' ';
if (($begin_id+200) < count($array))
	$end_id=$begin_id+200;
else $end_id=count($array);
echo 'jusqu\'à '.$end_id.'<br><br>';


for($i=$begin_id ; $i<$end_id ; $i++) {
	$id=intval($array[$i]);
	echo 'i='.$i.', id='.$id;

	// username
	$parameters = array('user_id' => $id);
	$result = $connection->get('users/show', $parameters);
	
	foreach ($result as $key => $value) {
		if($key=="errors"){
			echo '<br>Error : ';
			print_r($value);
			foreach ($value as $key2 => $value2) {
				if($key2=="code" and ($value2=="88" or $value2=88)){
					$_SESSION["id_get"]=$i;
					echo '<br>Je sauve id_get à '.$i;
					return;
				}
					
			}
		}

		if($key=="screen_name"){
			$name=$value;
		}
		else if($key=="followers_count"){
			echo ' followers_count='.$value;
			if($value>200){
				fwrite($fp, $id.','.$name.','.$value."\n");
			}
		}
	}

	echo '<br>';
}

fclose($fp);


?>
<?php

session_start();

header ("Refresh: 900;URL=get_data_users.php");

require_once('lib/twitteroauth.php');
require_once('config.php');

echo "<meta http-equiv=\"Content-Type\" content=\"text/HTML; charset=utf-8\" />";



$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);


if($connection)
	echo "connection worked<br/>";
	

$array = file('users_id_200.csv');
$fp = fopen('users_followers_200.csv', 'a');

echo 'count users=';
echo count($_SESSION["users"]);
echo '<br>';


$begin_id=intval($_SESSION["id_get"]);
echo 'Je reprends à '.$begin_id.'<br>';
if (($begin_id+20) < count($array))
	$end_id=$begin_id+20;
else $end_id=count($array);
echo 'jusqu\'à '.$end_id.'<br><br>';

for($i=$begin_id ; $i<$end_id ; $i++) {

	$ligne=$array[$i];
	$ligne_a=explode(',', $ligne);
	$id=$ligne_a[0];
	$username=$ligne_a[1];
	$nbreFollowers=intval($ligne[2]);

	echo 'i='.$i.', id='.$id.', followers => ';
	// echo '<br>';
	// fwrite($fp, $id.',');

	// Followers
	$parameters = array('user_id' => $id, 'count' => 5000);
	$followers = $connection->get('followers/ids', $parameters);

	// print_r($followers);
	$tab=array();
	foreach ($followers as $key => $value) {
		if($key=="errors"){
			echo '<br><b>Error :</b> ';
			print_r($value);
			echo '<br>Je sauve id_get à '.$i;
			$_SESSION["id_get"]=$i;
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

	// var_dump($followers);

	// $i++;	
}


fclose($fp);



?>
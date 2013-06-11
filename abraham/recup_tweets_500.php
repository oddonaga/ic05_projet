<?php

session_start();

require_once('lib/twitteroauth.php');
require_once('config.php');



$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);


if($connection)
	echo "connection worked<br/>";
	

$array = file('users_id_500.csv');
$fp = fopen('selection_tweets_500.json', 'a');
$file_json = file_get_contents("results.json");
$json = json_decode($file_json);

$users=array();
foreach ($array as $key => $value) {
	$tab=explode(',', $value);
	$users[]=$tab[0];
}


$array=$json->{'results'};
echo count($array);

for ($i=0; $i < count($array) ; $i++) { 
	$val=$array[$i];
	echo $val->{'from_user_id'};

    if(in_array($val->{'from_user_id'}, $users)){
    	echo " in array<br>";
    }
    else echo "<br>";
}


fclose($fp);


?>
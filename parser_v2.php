<?php 

session_start();
echo "<meta http-equiv=\"Content-Type\" content=\"text/HTML; charset=utf-8\" />";


$array = file('./abraham/tweets_and_names_200.csv');
$fp = fopen('selection_tweets_200.json', 'a');
$file_json = file_get_contents("./abraham/results.json");
$json = json_decode($file_json);

$users=array();
foreach ($array as $key => $value) {
	$tab=explode(',', $value);
	$users[]=$tab[0];
}

$session_tweets=array();


$array=$json->{'results'};
echo count($array);

for ($i=0; $i < count($array) ; $i++) {
	$tweet=$array[$i];
	$id=$tweet->{'from_user_id'};
	
	if(in_array($id, $users)){
		// echo '<br>'.$id;
		fwrite($fp, json_encode($tweet));
		$date=date_create($tweet->{'created_at'});
		$timestamp=$date->getTimestamp();
		$session_tweets[]=array(
			'user_id' => $tweet->{'from_user_id'},
			'username' => $tweet->{'from_user'},
			'text' => $tweet->{'text'},
			'date' => $timestamp,
			'id' => $tweet->{'id'},
		);
	}

}

$_SESSION["id"]=0;
$_SESSION['tweets']=$session_tweets;
$_SESSION['users']=$users;

echo '<br> session : '.$_SESSION["id"].'<br>';
echo 'count='.count($_SESSION['tweets']);
echo '<br>';
print_r($_SESSION);


?>
<?

require_once('lib/twitteroauth.php');
require_once('config.php');



$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);


if($connection)
	echo "connection worked<br/>";
	


$users_file = fopen("users.txt", "r+");
$users = array();

if(filesize("users.txt")!=0)
{
	echo "fichier users non vide<br/>";
	$users = file("users.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	//print_r($users);
}
else
{
	echo "fichier users vide<br/>";
}


$since_id = 339795500000000000 - 5000000000000;
$max_id = 339795500000000000;


$array = array();
for($k=0; $k<100; $k++)    //k<150
{

	$parameters = array('q' => '#mariagepourtous', 'rpp' => 100, 'since_id' => $since_id ,'max_id' => $max_id);
	$result = $connection->get('search', $parameters);
	
	foreach($result as $key1 => $value1)
	{		
	
		if($key1 == "results")
		{
			
			foreach($value1 as $key2 => $value2)
			{
				$tweet = array();
				
				$i++;
				
				foreach($value2 as $key3 => $value3)
				{
					if($key3 == "created_at" || $key3 == "id" || $key3 == "text" || $key3 == "from_user" || $key3 == "from_user_id")
						$tweet[$key3] = $value3;
				}	
				if(!in_array($tweet["from_user_id"], $users))
				{	
					//echo $tweet["created_at"];
					array_push($users, $tweet["from_user_id"]);
					array_push($array, $tweet);		
				}
			}
				
		}
			
	}
	
	$max_id = $since_id;
	$since_id = $since_id - 500000000000;
	
	echo $max_id;
	echo "<br/>";
	

}

foreach($users as $user)
{
	fwrite($users_file, $user . "\n");
}

fclose($users_file);

$results = json_encode(array("results" => $array));

$myFile = "results2-2.json";
$file = fopen($myFile, 'w');
fwrite($file, $results);
fclose($results);


/*
	1. Generation d'approximativement 586 requetes (a couper en 4 fois --> stockage dans un fichier)
	2.	Selection de 1000 tweets aleatoire
	3. --> dans un fichier json
	
	
*/


?>

<html>


<head>



</script>


</head>

<body>



</body>
</html>
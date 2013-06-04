<?


$content1 = file_get_contents("results2-1.json");
$content2 = file_get_contents("results2-2.json");
//$content3 = file_get_contents("results3.json");


$tweet1 = json_decode($content1);	//5029 tweets
$tweet2 = json_decode($content2);	//2984 tweets 
//$tweet3 = json_decode($content3);

/*
var_dump($tweet1);
echo "<br/><br/><br/><br/>";
echo "<br/><br/><br/><br/>";
echo "<br/><br/><br/><br/>";
echo "<br/><br/><br/><br/>";
echo "<br/><br/><br/><br/>";
echo "<br/><br/><br/><br/>";
echo "<br/><br/><br/><br/>";
echo "<br/><br/><br/><br/>";
echo "<br/><br/><br/><br/>";
echo "<br/><br/><br/><br/>";
echo "<br/><br/><br/><br/>";
echo "<br/><br/><br/><br/>";
echo "<br/><br/><br/><br/>";
var_dump($tweet2);
*/
//var_dump($tweet3);


$array1 = $tweet1->{'results'};
$array2 = $tweet2->{'results'};



$numeros = array();
$tweets_finaux = array();

for($i=0;$i<500;$i++)
{
	$ok = 0;
	while($ok==0)
	{
		$x = rand(0,2838+162);
		if(!in_array($x,$numeros))
		{
			$numeros[$i] = $x;
			$ok=1;
		}
	}
}


for($i=0;$i<500;$i++)
{
	$index = $numeros[$i];
	if($index<162)
	{
		//print_r($array1[$index]);	
		array_push($tweets_finaux,$array1[$index]);
	}
	else
	{
		$index = $index-162;
		//print_r($array2[$index]);		
		array_push($tweets_finaux, $array2[$index]);
	}
}


print_r($tweets_finaux);
$results = json_encode(array("results" => $tweets_finaux));

$myFile = "tweets2.json";
$file = fopen($myFile, 'w');
fwrite($file, $results);
fclose($results);


?>
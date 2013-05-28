<?

session_start();


echo "<meta http-equiv=\"Content-Type\" content=\"text/HTML; charset=utf-8\" />";

	


$parameters = array('q' => '#mariagepourtous', 'rpp' => 100);
$result = $connection->get('search', $parameters);

$array=array();
$i=0;


foreach ($result as $key => $value) {
	if($key=="results")
		foreach ($value as $key2 => $value2) {
			// echo '<br>';
			// print_r($value2);
			
			
			foreach ($value2 as $key3 => $value3) {
				if($key3=="from_user_id") $array[$i]["user_id"]=$value3;
				elseif($key3=="text") $array[$i]["text"]=$value3;
			}

			$array[$i]["tweet"]=$value2;

			$i++;
		}
}

$_SESSION["array"]=$array;
$_SESSION["id"]=0;



?>

<html>


<head>



</script>


</head>

<body>

Coucou

<p id="result"></p>


</body>
</html>
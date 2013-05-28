<?

require_once('lib/twitteroauth.php');
require_once('config.php');



$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);


if($connection)
	echo "connection worked<br/>";
	


$parameters = array('q' => '#mariagepourtous', 'rpp' => 100);
$result = $connection->get('search', $parameters);


print_r($result);

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
<head>
	<script>
	function submit(){
		document.formulaire.action = 'form.php';
		document.formulaire.submit();
	}
	</script>
</head>

<?php session_start(); 

echo "<meta http-equiv=\"Content-Type\" content=\"text/HTML; charset=utf-8\" />";


// print_r($_SESSION["array"]); 


if($_GET["choix"]){
	$fp = fopen('data.csv', 'a');

	$user=$_SESSION["array"][$_SESSION["id"]]["u"];
	$date=$_SESSION["array"][$_SESSION["id"]]["d"];
	$text=$_SESSION["array"][$_SESSION["id"]]["t"];
	$choix=$_GET["choix"];
	$session_id=$_SESSION["id"];

	$_SESSION["tweets"][$session_id]=$text;
	$_SESSION["tweets_choix"][$session_id]=$choix;

	fwrite($fp, $user.','.$choix.','.$date."\n");
	


	$_SESSION["id"]=$session_id+1;
	$text_suivant=$_SESSION["array"][$_SESSION["id"]]["t"];
	if($key = array_search($text_suivant, $_SESSION["tweets"])){
		// retweet -> on écrit directement dans data.csv
		// echo '<br>RETWEET de '.$key.' : '.$_SESSION["array"][$_SESSION["id"]]["t"].'<br>user : '.$_SESSION["array"][$_SESSION["id"]]["u"].'<br>';
		$user=$_SESSION["array"][$_SESSION["id"]]["u"];
		$choix=$_SESSION["tweets_choix"][$key];
		$date=$_SESSION["array"][$_SESSION["id"]]["d"];
		fwrite($fp, $user.','.$choix.','.$date."\n");
		$_SESSION["id"]=$_SESSION["id"]+1;
	}

	fclose($fp);
}

?>

<br><br>
<p>
	<?php echo 'session_id='.$_SESSION["id"].'<br>';
	echo 'user = <a href=\'https://twitter.com/'.$_SESSION["array"][$_SESSION["id"]]["n"].'\' target=\'_blank\'>'.$_SESSION["array"][$_SESSION["id"]]["n"].'</a><br>';
	echo '<br>';
	echo $_SESSION["array"][$_SESSION["id"]]["t"]; ?>
</p>

<form name="formulaire" method="GET" action="">
	<input type="radio" name="choix" value="pour" onClick="submit();">Pour la loi</input>
	<input type="radio" name="choix" value="contre" onClick="submit();">Contre la loi</input>
	<input type="radio" name="choix" value="neutre" onClick="submit();">Neutre</input>
</form>


<!-- Format du fichier csv sortant : user_id,choix,date -->
<!-- avec choix=pour|contre|neutre -->

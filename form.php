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


// print_r($_SESSION["tweets"]); 


if($_GET["choix"]){
	$fp = fopen('data.csv', 'a');

	$user=$_SESSION["tweets"][$_SESSION["id"]]["user_id"];
	// $username=$_SESSION["tweets"][$_SESSION["id"]]["username"];
	$date=$_SESSION["tweets"][$_SESSION["id"]]["date"];
	$text=$_SESSION["tweets"][$_SESSION["id"]]["text"];
	// $tweet_id=$_SESSION["tweets"][$_SESSION["id"]]["id"];

	$choix=$_GET["choix"];
	$session_id=$_SESSION["id"];

	fwrite($fp, $user.','.$date.','.$choix."\n");
	
	$_SESSION["id"]=$session_id+1;

	fclose($fp);
}

?>

<br><br>
<p>
	<?php echo 'session_id='.$_SESSION["id"].'<br>';
	echo 'user = <a href=\'https://twitter.com/'.$_SESSION["tweets"][$_SESSION["id"]]["username"].'\' target=\'_blank\'>'.$_SESSION["tweets"][$_SESSION["id"]]["username"].'</a><br>';
	echo '<br>';

	$string = $_SESSION["tweets"][$_SESSION["id"]]["text"]; 
	$pattern = "/(http:\/\/)([a-zA-Z0-9\/.]+)/"; 
	$replacement = "<a href='\\1\\2' target='_blank'>\\1\\2</a>"; 
	$text_url = preg_replace($pattern, $replacement, $string); 
	echo $text_url; ?>
</p>

<form name="formulaire" method="GET" action="">
	<input type="radio" name="choix" value="pour" onClick="submit();">Pour la loi</input>
	<input type="radio" name="choix" value="contre" onClick="submit();">Contre la loi</input>
	<input type="radio" name="choix" value="neutre" onClick="submit();">Neutre</input>
</form>


<!-- Format du fichier csv sortant : user_id,usernname,date,choix -->
<!-- avec choix=pour|contre|neutre -->

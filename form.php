<?php session_start(); 

// $_SESSION["id"]=0;
echo 'id='.$_SESSION["id"];

print_r($_SESSION["array"]); 

if($_GET["choix"]){
	$fp = fopen('data.csv', 'a');
	fwrite($fp, "\n");

	$user=$_SESSION["array"][$_SESSION["id"]]["user"];
	$a1=explode(":",$user);
	$a2=explode(",", $a1[1]);


	fwrite($fp, $a2[0]);

	fwrite($fp, ',');
	fwrite($fp, $_GET["choix"]);
	fclose($fp);
	$_SESSION["id"]=$_SESSION["id"]+1;
}


?>

<br><br>
<p>
	<?php echo $_SESSION["array"][$_SESSION["id"]]["text"]; ?>
</p>
<form action="form.php" method="GET">
	<input type="radio" name="choix" value="pour">Pour</input>
	<input type="radio" name="choix" value="contre">Contre</input>
	<input type="radio" name="choix" value="neutre">Neutre</input>
	<input type="submit" value="ok"></input>
</form>



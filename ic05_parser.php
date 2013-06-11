<?

session_start();


echo "<meta http-equiv=\"Content-Type\" content=\"text/HTML; charset=utf-8\" />";

	
// print_r($_SESSION["array"]);

$array=array();
$i=-2;

$string = file_get_contents("./data/tweets2.json");


$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($string, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) {
	    if(is_array($val)) {
	        // echo "key=".$key.":<br><br>";
	        $i++;
	        $array[$i]=array();
	    }else{
	        // echo $key." => ".$val."<br><br>";
	        if($key=="from_user_id") $array[$i]["u"]=$val;
	        else if($key=="text") $array[$i]["t"]=$val;
	        else if($key=="created_at") $array[$i]["d"]=$val;
	        else if($key=="from_user") $array[$i]["n"]=$val;
	    }
}




$_SESSION["array"]=$array;
$_SESSION["id"]=0;
$_SESSION["tweets"]=array();
$_SESSION["tweets_choix"]=array();

echo "_SESSION[id]=".$_SESSION["id"]."<br><br>";

echo "_SESSION[array]=<br>";
print_r($array);

// u : from_user_id
// t : text
// d : created_at
// n : from_user

?>
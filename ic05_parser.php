<?php

session_start();

$lines = file('./result1.json');

$bool1=false;
$bool2=false;

$array=array();
$i=0;

foreach ($lines as $lineNumber => $lineContent){

	// $lineContent=utf8_encode($lineContent);

	if($bool){
		echo $lineContent.'<br>';
		$array[$i]["user"]=$lineContent;
		$bool=false;
	}
	if(strpos($lineContent, "\"text\"")){
		if(!$array[$i]["text"])
			$array[$i]["text"]=$lineContent.' / ';
		$array[$i]["text"].=$lineContent.' / ';
		echo $lineContent.'<br>';
	}
		
	if(strpos($lineContent, "\"user\"")){
		// echo $lineContent.'<br>';
		$bool=true;
	}

	if(strpos($lineContent, "\"symbols\"")){
		echo '--------------------------------------------<br>';
		$i++;
	}


		
}

$_SESSION["array"]=$array;
$_SESSION["id"]=0;

?>
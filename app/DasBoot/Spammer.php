<?php
echo "<H1>SPAMMING</H1>";
$T 		= new \app\Twert\Twert();
$data = $T->getRecent();

$twertids = array();
foreach($data as $id => $twerts){
	foreach($twerts as $i => $twert){
		echo "$$$$ twert --> ";
		var_Dump($twert);
		$T->sendTweet($twert);
	}
	$T->putTimeStamp($id);
}

?>
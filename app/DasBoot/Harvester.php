<?php
echo "<H1>HARVESTING</H1>";
//Select videos
$V 		= new \app\Twert\Video();
$videos = $V->get();

//Get Top Trends
foreach($videos as $i => $video){

	$W 		= new \app\Twert\Keyword(null, $video['id']);
	$words  = $W->get();

	foreach($words as $i => $word){

		$messages 	= $W->getMessages($word['word']);

		$N = new \app\Twert\Name(null, $word['id']);
		$N->postAll($messages);

		$H = new \app\Twert\Hash(null, $word['id']);
		$H->postAll($messages);

	}
}

?>
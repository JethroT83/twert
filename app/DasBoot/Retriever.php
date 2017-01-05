<?php
echo "<H1>RETRIEVING</H1>";
//Update Video List
$V = new \app\Twert\Video();
$V->updateVideoList();

//Update Database
$W = new \app\Twert\Keyword();
$W->putKeywords();

$T = new \app\Twert\Twert();
$T->putTwerts();


?>
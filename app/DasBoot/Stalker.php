<?php
echo "<H1>STALKING</H1>";
//Get Unfollowed Screen Names
$N  = new \app\Twert\Name();
$follows = $N->getUnfollowedUsers();

//Follow New Users
foreach($follows as $i => $screen_name){

	$F = new \app\Twert\Follow();
	$F->follow($screen_name);
	$F->post($screen_name);
}


?>
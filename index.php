<?php

	#Run AutoLoad
	require(__DIR__ . '/app/autoload.php');
	
	#Include Database Credentials
	require(__DIR__ . '/app/Database/connection.php');
	
	################  TEST         ##################

	#$statement = "Select * FROM twert.video";
	#$data = $GLOBALS['connection']->query($statement);
	#echo "Data ---> ";
	#var_dump($data);

	################  Running Code ##################


	define('CONSUMER_KEY', getenv('CONSUMER_KEY'));
	define('CONSUMER_SECRET', getenv('CONSUMER_SECRET'));
	define('OAUTH_CALLBACK', getenv('OAUTH_CALLBACK'));
	

	$S = new \app\Helper\Session();
	$S->startSession();

	#Retriever
	#include("app/DasBoot/Retriever.php");
	
	#Harvester
	include("app/DasBoot/Harvester.php");

	#Stalker
	#include("app/DasBoot/Stalker.php");

	#Spammer
	include("app/DasBoot/Spammer.php");
?>
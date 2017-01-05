<?php

	$classloader  = __DIR__ . "/vendor/composer/ClassLoader.php";

	require($classloader);
	$loader = new \Composer\Autoload\ClassLoader();
	$loader->addPsr4('app\\', array(__DIR__ )  );
	$loader->register();

?>
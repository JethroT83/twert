# twert
This app sends out tweets via API by responding to what is trending for a given query.


# Composer.json
The dependencies are not committed, therefore you will have to install and run composer for php.

The documentation and download is at the website here...  https://getcomposer.org/

Setup composer with $PATH or binary
Go to the app folder.
Run php composer.phar install 

# Twitter
You are going to need to setup a Twitter Developer account.
You can do that here...  https://dev.twitter.com/
You need to get the following... costumerKey, secret, accessToken, accessSecret.

Once you have those paste them in the app/Helper/Session.php file...

	$array = array(			 
		'costumerKey'  	=> "",
		'secret' 		=> "",
		'accessToken'   => "",
		'accessSecret'  => ""

	);

#DataBase
Open the file "database_tables"
Create a database "twert"
Run the query

Set up your credentials in app/Database/connection.php

	$GLOBALS['server'] 	   = "localhost";
	$GLOBALS['username']   = "root";
	$GLOBALS['password']   = "";
	$GLOBALS['database']   = "twert";

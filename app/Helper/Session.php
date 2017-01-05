<?php
namespace app\Helper{
	class Session {

		//Gets given credentials from Twatter
		public function getCredentials(){

			# Later on....
			//$statemene = "SELECT FROM DATABASE TABLE AND SHIT WHERE CREDENTIALS WILL BE STORED AT SOME POINT";
			//$GLOBALS['connection']->querySelect($statment);

			#For Now

			$array = array(			 
				'costumerKey'  	=> "u***********************4",
				'secret' 		=> "F**********************************************8",
				'accessToken'   => "7**********************************************s",
				'accessSecret'  => "Z*****************************************7"

			);

			return $array;
		}

		public function startSession(){

			//Get Giver Credentials
			$creds = $this->getCredentials();
			
			//Calls Vendor Library
			$VR  = new \app\Helper\VendorResolve();
			$VR->twitteroauth();

			//Makes Request for Token... starting the session
			$A   			= new \Abraham\TwitterOAuth\TwitterOAuth($creds['costumerKey'], $creds['secret'],$creds['accessToken'] , $creds['accessSecret']);
			$request_token 	= $A->oauth('oauth/request_token', ['oauth_callback' => OAUTH_CALLBACK]);

			//Stores the toke in a global variable
			switch ($A->getLastHttpCode()) {
			    case 200:
			        // Save temporary credentials to session. 
			        $_SESSION['oauth_token'] = $request_token['oauth_token'];
			        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
			        // Build authorize URL and redirect user to Twitter. 
			        $url = $A->url('oauth/authorize', ['oauth_token' => $request_token['oauth_token']]);
			        $_SESSION['object'] = $A;
			        return true;
			        break;
			    default:
			        // Show notification if something went wrong. 
			        echo 'Could not connect to Twitter. Refresh the page or try again later.';
			        return false;
			}
		}
	}
}
<?php
namespace app\Helper{
	class Parser {

		//Gets given credentials from Twatter
		public static function getFollowees($info){

			$followees = array();
			foreach($info->entities->user_mentions as $i => $user_mention){

				array_push($followees, "@".$user_mention->screen_name);
			}

			return $followees;
		}

		public static function getHashes($info){

			$hashtags = array();
			foreach($info->entities->hashtags as $i => $hash){

				array_push($hashtags, "#". $hash->text);
			}

			return $hashtags;
		}

		//Gets given credentials from Twatter
		public static function getFolloweesText(&$t, $names = array() ){

			//Find Start of name
			$pos1 = strpos($t, '@');
			$t 		= substr($t,$pos1);
			
			//Define name characters
			$nameChar = "@abcdefghijklmnopqrstuvwxyzABCDEFGHIJLMNOPQRSTUVWXYZ0123456789_";		
			
			//Go through string to make sure there are no characters not in the string above
			$l = strlen($t);
			$nameString  = "@";
			for($i=0;$i<=$l;$i++){
				
				//character in sting
				$char = substr($t, $i, 1);		
			
				//starting from right to left, search to see character is in the sting $nameChar
				if( strpos($nameChar, $char ) ){
							$nameString  .= $char;//add to nameString if true
				}else{ break;}//break if false
	    	}
			
			//push parse name to the names array
			if($nameString != "@"){array_push($names, $nameString);}
			
			
			//search for other names with @
			$t = substr($t, strpos($t, '@') +1);
			
			//if there is another @, call the function again, else return the name list
			if( strpos($t, '@') !==false){ 
					return  self::getFollowees($t, $names);
			}else{	return $names;}
		}


		//Gets given credentials from Twatter
		public static function getHashesText(&$t, $hashes = array() ){

			//Find Start of name
			$pos1 = strpos($t, '#');
			$t 	  = substr($t,$pos1);
			
			//Define name characters
			$hashChar = "#abcdefghijklmnopqrstuvwxyzABCDEFGHIJLMNOPQRSTUVWXYZ0123456789_";		
			
			//Go through string to make sure there are no characters not in the string above
			$l = strlen($t);
			$hashString  = "#";
			for($i=0;$i<=$l;$i++){
				
				//character in sting
				$char = substr($t, $i, 1);		
			
				//starting from right to left, search to see character is in the sting $nameChar
				if( strpos($hashChar, $char ) ){
							$hashString  .= $char;//add to nameString if true
				}else{ break;}//break if false
	    	}
			
			//push parse name to the hashes array
			if($hashString != "#"){array_push($hashes, $hashString);}
			
			
			//search for other hashes with #
			$t = substr($t, strpos($t, '#') +1);//
			
			//if there is another #, call the function again, else return the name list
			if( strpos($t, '#') !==false){ 
					return  self::getHashes($t, $hashes);
			}else{	return $hashes;}
		}

		public static function merge($assets, $newAssets){

			foreach($newAssets as $i => $newAsset){

				if( !in_array($newAsset, $assets) ){

					array_push($assets, $newAsset);
				}
			}

			return $assets;
		}


	}
}

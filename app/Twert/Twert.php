<?php

namespace app\Twert{
	class Twert  extends \app\Common{

		public $table 			= "twert.twert";
		public $primaryKeyField = "id";


	#GET
		public function get(){

			$statement = "SELECT t.id as twertid, v.id as videoid, t.twert, v.link FROM twert.twert t
							LEFT JOIN twert.video v ON v.id = t.videoid
							ORDER BY t.id asc";

			return $GLOBALS['connection']->query($statement);
		}

		public function getRecent(){

			$statement = "SELECT t.id as twertid, t.twert, v.link, h.hash,v.lastpost
							FROM twert.twert t
								LEFT JOIN twert.video v ON v.id = t.videoid
								LEFT JOIN twert.keyword w ON t.videoid = w.videoid  
								LEFT JOIN twert.hash h  ON w.id = h.keywordid
							WHERE v.lastpost < h.timestamp
							GROUP BY concat(v.id,h.hash) 
 							ORDER BY t.id asc";

 			$tweets    = $GLOBALS['connection']->query($statement);
			$outTweets = array();
			$tweetid   = 0;
			foreach($tweets as $i => $tweet){

				//Query Sorts by Tweets, the outtwert can reset when id changes
				if(	$tweet['twertid'] != $tweetid){
					
					$tweetid 				= $tweet['twertid'];
					$outTweets[$tweetid]	= array();
					$outTweet 				= $tweet['twert'];

				}else{
					//The tweet needs to fit the link yet be under 140 characters
					if( strlen($outTweet ." ". $tweet['hash']." ". $tweet['link']) <= 140
						&& $i != count($tweets) -1  
					){
									
						$outTweet 	.= " " . $tweet['hash'];
					}
					//Only send tweet if there is a hash in the messages
					else if(strpos($outTweet, '#') !== false ){

						$outTweet 	.= " " . $tweet['link'];
						array_push($outTweets[$tweetid], $outTweet);
						$outTweet 	= $tweet['twert'];
					} 
				}
			}

			return $outTweets;
		}

		/*public function getPopular(){

			$statement = "SELECT t.id as twertid, t.twert, v.link, h.hash, count(h.hash) as count
							FROM twert.twert t
								LEFT JOIN twert.video v 	ON v.id 		= t.videoid
								LEFT JOIN twert.keyword w 	ON t.videoid 	= w.videoid  
								LEFT JOIN twert.hash h  	ON w.id 		= h.keywordid
							GROUP BY t.id,h.hash
 							ORDER BY t.id, count(h.hash) desc";

			$tweets     = $GLOBALS['connection']->query($statement);
			$outTweets 	= array();
			$tweetid    = 0;
			foreach($tweets as $i => $tweet){
				//echo "<br><br> ---> "; var_dump($tweet);
				//Query Sorts by Tweets, the outtwert can reset when id changes
				if(	$tweet['count'] > 5){
					
					$tweetid 	= $tweet['twertid'];
					$outTweet 	= $tweet['twert'];

				//The tweet needs to fit the link yet be under 140 characters
				}else if( strlen($outTweet ." ". $tweet['hash']." ". $tweet['link']) <= 140){
					
					$outTweet 	.= " " . $tweet['hash'];

				//Only send tweet if there is a hash in the messages
				}else if(strpos($outTweet, '#') !== false){
					$outTweet 	.= " " . $tweet['link'];
					array_push($outTweets, $outTweet);
					$outTweet 	= $tweet['twert'];
				}
			}

			return $outTweets;

		}*/

						//$id = array_search($index, trim($row[2]);
						//$statement = "UPDATE twert.twert SET active = 1 WHERE id = $id";
						//$GLOBALS['connection']->query($statement);
	#PUT
		//Case 1, Inactive restored to active --  blank to tweet in csv
		//Case 2, Active to Inactive -- tweet not in csv to blank 

		public function putTwerts(){

			$GLOBALS['connection']->query("Truncate twert.twert");

			$statement 	= "INSERT INTO twert.twert (`videoid`, `twert`) ";
			$length     = strlen($statement);

			$rows = $this->CSV_to_array("ftp/twert");
			foreach($rows as $i => $row){
				if($i>0 && strlen($row[2]) > 0){

					if( strlen($statement) == $length ){

						$statement .= "VALUES ('" . $row[0] . "', '" . addslashes($row[2]) . "')";
					}else{

						$statement .= ", ('" . $row[0] . "', '" . addslashes($row[2]) . "')";
					}				
				}
			}

			$GLOBALS['connection']->query($statement);
		}

		public function putTimeStamp($id){

			$statement = "UPDATE twert.video 
							Set `lastpost` = CURRENT_TIMESTAMP 
							WHERE id IN (SELECT videoid 
											FROM twert.twert 
											WHERE id = $id)";
			$data = $GLOBALS['connection']->query($statement);
		}


	#MISC
		public function sendTweet($tweet){

			if(!is_object($_SESSION['object'])){return false;}

			$path 	= "statuses/update";
			$params = array("status" => $tweet);
			$data 	= $_SESSION['object']->post($path, $params);

			//var_dump($data);
		}
	}
}

?>
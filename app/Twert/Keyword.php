<?php

namespace app\Twert{

	class Keyword  extends \app\Common{
		public $table 			= "twert.keyword";
		public $primaryKeyField = "twert.keyword.id";
		public $uniqueKeyField	= "videoid";

		public function __construct($id = null, $videoid = null){
			$this->primaryKey = $id;
			$this->uniqueKey  = $videoid;
		}

	#GET

		//Get trends from key word...
		public function getData($word){

			if(!is_object($_SESSION['object'])){return false;}

			$path = "search/tweets";
			$parameters = array("q" => $word);//, "search"=>$word);
			$data = $_SESSION['object']->get($path, $parameters);

			return $data;
		}

		public function getMessages($word){

			$data = $this->getData($word);

			$messages = array();
			foreach($data->statuses as $key => $info){

				$messge 				= array();
				$message['tweetid']  	= $info->id;
				$message['names']  		= \app\Helper\Parser::getFollowees($info);
				$message['hashes']  	= \app\Helper\Parser::getHashes($info);
				array_push($messages, $message);
				
			}
			
			return $messages;
		}



	#PUT
		public function putKeywords(){
			$GLOBALS['connection']->query("TRUNCATE twert.keyword");
			
			$statement 	= "INSERT INTO twert.keyword (`videoid`, `word`) ";
			$length     = strlen($statement);

			$rows = $this->CSV_to_array("ftp/twert");
			foreach($rows as $i => $row){
				if($i>0 && strlen($row[3]) > 0 ){
					$words = explode('@@',trim($row[3]));
					unset($words[0]);
					foreach($words as $j => $word){
						
						if( strlen($statement) == $length ){

							$statement .= "VALUES ('" . $row[0] . "', '" .addslashes(trim($word)) . "')";
						}else{

							$statement .= ", ('" . $row[0] . "', '" .addslashes(trim($word)) . "')";
						}
					}				
				}
			}
			$GLOBALS['connection']->query($statement);
		}

	}
}

?>
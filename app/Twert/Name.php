<?php

namespace app\Twert{

	class Name extends \app\Common{
		public $table 			= "twert.name";
		public $primaryKeyField = "id";


		public function __construct($id = null, $keywordid = null){

			$this->primaryKey = $id;
			$this->uniqueKey  = $keywordid;
		}

	#GET
		public function getTweetId(){

			$statement = 'Select tweetid FROM ' .$this->table;
			$data = $GLOBALS['connection']->query($statement);

			$ids = array();
			if(count($data) > 0){
				foreach($data as $i => $info){
					array_push($ids, $info['tweetid']);
				}
			}

			return $ids;
		}

		public function getUnfollowedUsers(){

			$statement = "SELECT name 
							FROM twert.name 
							WHERE name not in (SELECT name 
												FROM twert.follow)";
			$data = $GLOBALS['connection']->query($statement);

			$result = array();
			foreach($data as $i => $info){
				array_push($result, $info['name']);
			}

			return $result;
		}


	#POST
		public function postAll($messages){

			$Tids = $this->getTweetId();
			$c=0;
			$statement = "INSERT INTO twert.name (`keywordid`, `name`,`tweetid`, `timestamp`)";
			foreach($messages as $i => $info){

				$tweetid = $info['tweetid'];
				$names 	 = $info['names'];
				if( !in_array($tweetid,$Tids) ){
					//$statement = "INSERT INTO twert.name (`keywordid`, `name`,`tweetid`, `timestamp`)";

					foreach($names as $j => $name){

						if( $c == 0){
							$statement .= "VALUES('{$this->uniqueKey}', '$name','$tweetid', CURRENT_TIMESTAMP)";
						}else{
							$statement .= ",('{$this->uniqueKey}', '$name','$tweetid', CURRENT_TIMESTAMP)";	
						}
						$c++;
					}
				}
			}

			if($c > 0){

				$GLOBALS['connection']->query($statement);
					return true;
			}else{	return false;}
		}
	}
}

?>
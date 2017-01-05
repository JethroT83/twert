<?php

namespace app\Twert{

	class Hash  extends \app\Common{
		public $table 			= "twert.hash";
		public $primaryKeyField = "id";

		public function __construct($id, $keywordid){

			$this->primaryKey = $id;
			$this->uniqueKey  = $keywordid;
		}

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

		public function postAll($messages){

			$Tids = $this->getTweetId();
			$c=0;
			$statement = "INSERT INTO twert.hash (`keywordid`, `hash`,`tweetid`, `timestamp`)";
			foreach($messages as $i => $info){

				$tweetid = $info['tweetid'];
				$hashes  = $info['hashes'];

				if( !in_array($tweetid,$Tids) ){
					//$statement = "INSERT INTO twert.name (`keywordid`, `hash`,`tweetid`, `timestamp`)";

					foreach($hashes as $j => $hash){

						if( $c == 0){
							$statement .= "VALUES('".$this->uniqueKey ."', '$hash','$tweetid', CURRENT_TIMESTAMP)";
						}else{
							$statement .= ",('".$this->uniqueKey ."', '$hash','$tweetid', CURRENT_TIMESTAMP)";	
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
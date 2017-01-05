<?php

namespace app\Twert{

	class Follow extends \app\Common{
		public $table 			= "twert.follow";
		public $primaryKeyField = "id";

		public function __construct($id = null){
			
			if($id != null){$this->primaryKey = $id;}
		}

		public function post($screen_name){

			$statement  = "INSERT INTO " . $this->table;
			$statement .= "(`name`, `timestamp`)";
			$statement .= "VALUES ('$screen_name', CURRENT_TIMESTAMP)";
			//echo $statement;
			$GLOBALS['connection']->query($statement);
 		}

		public function follow($screen_name){

			//Get Current Followers
			$statement = "SELECT * FROM " . $this->table;
			$follows = $GLOBALS['connection']->query($statement);
			$users   = array();
			foreach($follows as $i => $follow){
				array_push($users, $follow['name']);
			}

			//IF not following, then follow and post to table
			if(!in_array($screen_name, $users)){

				if(!is_object($_SESSION['object'])){return false;}

				$path 	= "friendships/create";
				$params = array("screen_name" => $screen_name);
				$data 	= $_SESSION['object']->post($path, $params);

			}
		}

	}
}

?>
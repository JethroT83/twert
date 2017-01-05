<?php

namespace app\Twert{

	class Video extends \app\Common{
		public $table 			= "twert.video";
		public $primaryKeyField = "id";


		public function getCurrent(){

			$statement = "SELECT * FROM twert.video
							Order By lastpost asc limit 0,2";
			return $GLOBALS['connection']->query($statement);
		}

		public function getVideoList(){

			$statement  = "SELECT v.id, v.title, t.twert,
							Replace(GROUP_CONCAT(' @@',w.word),',','') as keywords
							FROM twert.video v
							LEFT JOIN twert.twert t ON v.id = t.videoid
							LEFT JOIN twert.keyword w ON v.id = w.videoid
							GROUP BY v.id";
			return $GLOBALS['connection']->query($statement);
		}

	#MISC
		public function updateVideoList(){

			$videos = $this->getVideoList();

			$rows = array();

			//Define Columns
			$row = array("videoid","title","tweet","keywords");
			array_push($rows, $row);

			foreach($videos as $i => $video){
				$row = array(	$video['id'], 
								$video['title'], 
								$video['twert'],
								$video['keywords']);
				array_push($rows, $row);
			}
			
			$this->array_to_CSV($rows, "ftp/template");
		}
	}

}

?>
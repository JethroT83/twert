<?php


namespace app\Database{

	/*$GLOBALS['server'] 	   = "localhost";
	$GLOBALS['username']   = "someguy";
	$GLOBALS['password']   = "th3g00n16G";
	$GLOBALS['database']   = "twert";*/

	$GLOBALS['server'] 	   = "localhost";
	$GLOBALS['username']   = "root";
	$GLOBALS['password']   = "";
	$GLOBALS['database']   = "twert";

	class connection{

		function query($statement){
			if( 	stripos($statement,'update') !== false 
				||  stripos($statement,'insert') !== false
				||  stripos($statement,'truncate') !== false){	
					return $this->queryInsert($statement);
			}else{	return $this->querySelect($statement);}
		}

		function querySelect($statement){
			$connection  = new \mysqli($GLOBALS['server'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database']);
			$r = $connection->query($statement);
			$result = array();
			while ($row = $r->fetch_assoc()) {
			 	array_push($result, $row);
			}

			return $result;

			//return $connection->query($statement)->fetch_all(MYSQLI_ASSOC);
		}

		function queryInsert($statement){
			$connection  = new \mysqli($GLOBALS['server'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database']);
			return $connection->query($statement);
		}
	}

	$GLOBALS['connection'] =	new \app\Database\connection();

}
?>
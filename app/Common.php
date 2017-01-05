<?php
namespace app {
	set_time_limit(1200);
	Class Common{
		
		public function __construct($id = null){
				$this->primaryKey = $id;
		}

		public function get(){

			$statement = "SELECT * FROM " . $this->table;

			//Joins table
			if(isset($this->join) && $this->join != null){
				$statement .= $this->join;
			}
			
			//Uses primary or unique key
			if($this->primaryKey != null){
				$statement .= " WHERE {$this->primaryKeyField} = {$this->primarKey}";
			}else if(isset($this->uniqueKey) && $this->uniqueKey != null){
				$statement .= " WHERE {$this->uniqueKeyField} = {$this->uniqueKey}";
			}

			return $GLOBALS['connection']->query($statement);
		}

		public function curl($url, $headers = array()){
					
				$curl = curl_init();
				
				curl_setopt_array($curl, array(
					CURLOPT_RETURNTRANSFER 	=> 1,
					CURLOPT_URL 			=> $url,
					CURLOPT_HTTPHEADER 		=> $headers,
					//CURLOPT_USERAGENT => 'Codular Sample cURL Request',
					CURLOPT_POST 			=> 1
				));
				return curl_exec($curl);
			}
		
		//this decompresses zipped files
		public function unZip($source, $destination){
			$zip = new ZipArchive;
			if(is_file($source) == 1){
				if($zip->open($source) !== false){
							$zip->extractTo($destination);
							$zip->close();
							return "Success";
				}else{	echo "ERROR!";}
			}else{echo "<br>file not found, perhaps the function is pointing to the wrong directory<br>";}
		} 
		
		public function pclzip($source, $destination){
			$zipfile 	= new PclZip($source);
			if(is_file($source) == 1){$v_list = $zipfile->extract($source, $destination); }
		}
		
		//this retrieves a file from an FTP server
		#array = (ftp_server => , ftp_user => , ftp_psw=> );
		public function getFTP($creds= array(),  $ftp_file = NULL, $file_name = NULL){
		
			$f 		= fopen("feed/".$file_name, "wb+");
			$con 	= ftp_connect($creds['ftp_server']);
			$res 	= ftp_login($con, $creds['ftp_user'], $creds['ftp_psw']);
			
			//comando para el uso local 
			//command for using the localhost
			ftp_pasv($con, true);
	//FTP_BINARY
			if($ftp_file == null){
				return "no file found.";
			}else{
				if(ftp_fget($con, $f, $ftp_file, FTP_BINARY, 0)){
						return "Success";
				}else{ 	return "Error"; }
			}

			ftp_close($con);
			fclose($f);
		}
		
		//this is a function for searching for a value in a 2 dimensional array
		public function array_search_2d($needle, $haystack, $subkey=null, $end=false){
			$j=0;
			if(isset($haystack[key($haystack)])==1){
			if(isset($haystack[key($haystack)][key($haystack[key($haystack)])])==1){
				foreach ($haystack as $iterator => $array) {
					if($iterator>=$iterator){
						if($subkey==null){
							foreach($array as $key => $value){
								if ($value == $needle) {
									$this->iterator	=	$iterator;
									return $this->iterator;
								}
							}
						}else{
							if ($array[$subkey] == $needle) {
								
								if($end	==	false){
									$this->iterator	=	$iterator;
									return $this->iterator;
								}else if($end	==	true){
									$new[$j]	=	$iterator;
									$j++;
								}
							}
						}
					}
				}
				if($end	==	true){
					if(isset($new[0])==1){
						return $new;
					}else{
						return false;
					}
				}
			}
			}
			return false;
		}
		
		//function array_search_2d_all($needle, $haystack, $key2=null){
		//	$c	=	count($haystack);
		//	if($c>0){
		//		while($i<=$c){
		//			$new[0]	=	$this->array_search_2d($needle, $haystack, $key2=null);
		//			if($new[0]	!== false){
		//				$new[$j] =	$this->array_search_2d($needle, $haystack, $key2=null);
		//			}
		//		}
		//	}
		//}
		
	##This function gets rid of whitespace when 'trim' fails to work.
		public function off($string){
			$len	=	$string;
			$new='';
			for($x=0;$x<$len;$x++){
				$n 	=	substr($string, $x, 1);
				$as	=	ord($n);
			
				if($as != '32' || $as != '160'){// || $as == '9' || $as == '11' || $as == '12'){
					$new	.=	$n;
				}
			}
			return $new;
		}
		
		public function array_to_CSV($array, $filename){
			$keys	=	$array[0];
			unset($array[0]);
			$f		=	fopen($filename.".csv" ,'w');
			fputcsv ($f	 , $keys);
			
			foreach($array as $i => $info){
				fputcsv ($f	 , $info);
			}
			
			fclose($f);
		}
	

		public function CSV_to_array($filename){
				
			if(is_file($filename.".csv") !== false){
				$f 		= fopen($filename.".csv","r");
				$rows 	= array();
				while (($row = fgetcsv($f, 10000, ",")) !== FALSE) {
				    array_push($rows, $row);
				}
				return$rows;
			}else{
				return "not a file";
			}
		}
	}
}
?>
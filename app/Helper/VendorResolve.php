<?php

namespace app\Helper{

	class VendorResolve  extends \app\Common{

		public function twitteroauth(){

			include("app/vendor/twitteroauth/autoload.php");			
		}
		
	}
}


?>
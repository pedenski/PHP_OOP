<?php
class validate {

	public function check_empty($data,$fields){
		foreach($fields as $value) {
			if(empty($data[$value])) {
				$msg = "empty field"; 	
			}
			return $msg;
		}

	}


}



?>
<?php	
function pwdValidate($field){
		$field = trim($field);
		if (strlen($field) < 10){
			return false;
		}
		else {
		//go through each character and find if there is a number or letter
			$letter = false;
			$number = false;
			$chars = str_split($field);
			for($i = 0; $i<strlen($field); $i++){
				if (preg_match("/[A-Za-z]/",$chars[$i])){
					$letter = true;
					break;
				}
	
			}
	
			for($i = 0; $i<strlen($field); $i++){
				if (preg_match("/[0-9]/",$chars[$i])){
					$number = true;
					break;
				}
	
			}
			if (($letter == true) and ($number == true)){
				return true;
			}
			else return false;
	
	
			
	 
		}
	
	}
?>

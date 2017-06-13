<?php

//Checks email entry
function spamcheck($field)
  {
  //filter_var() sanitizes the e-mail
  //address using FILTER_SANITIZE_EMAIL
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);

  //filter_var() validates the e-mail
  //address using FILTER_VALIDATE_EMAIL
  if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
    return TRUE;
    }
  else
    {
    return FALSE;
    }
  }

//Used to check password requirements (at least 8 characters, and at least 1 number)
function pwdValidate($field){
	$field = trim($field);
	if (strlen($field) < 10){
		return false;
		}
	else {
		//go through each character and find if there is a number or letter
		$number = false;
		$chars = str_split($field);

		for($i = 0; $i<strlen($field); $i++){
			if (preg_match("/[0-9]/",$chars[$i])){
				$number = true;
				break;
			}

		}
		if ($number == true){
			return true;
		}
		else return false;
	}}
	
	// Generates a random code with a given length that is given to the function
	function randomCodeGenerator($length){
          $code = "";
         for($i = 0; $i<$length; $i++){
             //generate a random number between 1 and 35
             $r = mt_rand(1,35);
             //if the number is greater than 26, minus 26 will generate a digit between 0 and 9
             if ($r > 26) {
                $r = $r - 26;
                $code = $code.$r ;
            }
             else {    //it's between 1 and 26, generate a character

                 $code = $code.toChar($r);
             }

         }
         return $code;}
		 
function toChar($digit){
         $char = "";
         switch ($digit){
                case 1: $char = "A"; break;
                case 2: $char = "B"; break;
                case 3: $char = "C"; break;
                case 4: $char = "D"; break;
                case 5: $char = "E"; break;
                case 6: $char = "F"; break;
                case 7: $char = "G"; break;
                case 8: $char = "H"; break;
                case 9: $char = "I"; break;
                case 10: $char = "J"; break;
                case 11: $char = "K"; break;
                case 12: $char = "L"; break;
                case 13: $char = "M"; break;
                case 14: $char = "N"; break;
                case 15: $char = "O"; break;
                case 16: $char = "P"; break;
                case 17: $char = "Q"; break;
                case 18: $char = "R"; break;
                case 19: $char = "S"; break;
                case 20: $char = "T"; break;
                case 21: $char = "U"; break;
                case 22: $char = "V"; break;
                case 23: $char = "W"; break;
                case 24: $char = "X"; break;
                case 25: $char = "Y"; break;
                case 26: $char = "Z"; break;
                default: "A";

         }
         return $char;
}

//used to make sure the code is at least 50 characters for validation
function codeValidate($field){
	$field = trim($field);
	if (strlen($field) < 50){
		return false;}
	else return true;
	}

?>
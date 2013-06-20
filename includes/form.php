<?php

class Form{
	private $sHTML;
	private $aData;
	private $aErrors;

	public function __construct(){
		$this->sHTML = '<form action="" method="post"><fieldset>';
		$this->aData = array();
		$this->aErrors = array();
	}

	public function makeInput($sControlName,$sLabel){

		$sData = "";
		// if data exists, put it into sData and use it for the value
		if(isset($this->aData[$sControlName])){
			$sData = trim($this->aData[$sControlName]);
		}

		$sErrors = "";
		// if there is an error under this controlname
		if(isset($this->aErrors[$sControlName])){
			$sErrors = $this->aErrors[$sControlName];
		}

		$this->sHTML .= '<label for="'.$sControlName.'">'.$sLabel.'</label>
		<input type="text" name="'.$sControlName.'" value="'.$sData.'" />
		<div class="error">'.$sErrors.'</div>';
	}

	public function makePasswordInput($sControlName,$sLabel){

		$sData = "";
		// if data exists, put it into sData and use it for the value
		if(isset($this->aData[$sControlName])){
			$sData = trim($this->aData[$sControlName]);
		}

		$sErrors = "";
		// if there is an error under this controlname
		if(isset($this->aErrors[$sControlName])){
			$sErrors = $this->aErrors[$sControlName];
		}

		$this->sHTML .= '<label for="'.$sControlName.'">'.$sLabel.'</label>
		<input type="password" name="'.$sControlName.'" value="'.$sData.'" />
		<div class="error">'.$sErrors.'</div>';
	}

	public function makeConfirmPasswordInput($sControlName,$sLabel){

		$sErrors = "";
		// if there is an error under this controlname
		if(isset($this->aErrors[$sControlName])){
			$sErrors = $this->aErrors[$sControlName];
		}

		$this->sHTML .= '<label for="'.$sControlName.'">'.$sLabel.'</label>
		<input type="password" name="'.$sControlName.'" />
		<div class="error">'.$sErrors.'</div>';
	}

	public function makeTextArea($sControlName,$sLabel){
		$sData = "";
		// if data exists, put it into sData and use it for the value
		if(isset($this->aData[$sControlName])){
			$sData = trim($this->aData[$sControlName]);
		}

		$sErrors = "";
		// if there is an error under this controlname
		if(isset($this->aErrors[$sControlName])){
			$sErrors = $this->aErrors[$sControlName];
		}

		$this->sHTML .= '<label for="'.$sControlName.'">'.$sLabel.'</label>
		<textarea type="text" name="'.$sControlName.'" col="10" rows="20">'.$sData.'</textarea>
		<div class="error">'.$sErrors.'</div>';
	}

	public function makeSubmit($sControlName,$sLabel){
		$this->sHTML .= '<input type="submit" name="'.$sControlName.'" value="'.$sLabel.'" />';
	}

	public function checkRequired($sControlName){
		$sData = "";

		// if data has this controlname, trim it
		if(isset($this->aData[$sControlName])){
			$sData = trim($this->aData[$sControlName]);
		}

		// if the trimmed string length is 0, create a new row in the errors array
		if(strlen($sData)==0){
			$this->aErrors[$sControlName] = "* Required";
		}else{
			return true;
		}


	}

	public function checkEmail($sControlName){
		if($this->checkRequired($sControlName) == true){



			$email = "";

			// trim data
			if(isset($this->aData[$sControlName])){
				$email = trim($this->aData[$sControlName]);
			}


			// CHECK EMAIL VALIDATION from http://www.linuxjournal.com/article/9585?page=0,3

			$isValid = true;
			$atIndex = strrpos($email, "@");
			if (is_bool($atIndex) && !$atIndex){
				$isValid = false;
			}else{
				$domain = substr($email, $atIndex+1);
				$local = substr($email, 0, $atIndex);
				$localLen = strlen($local);
				$domainLen = strlen($domain);
				if ($localLen < 1 || $localLen > 64){
					// local part length exceeded
					$isValid = false;
				}else if ($domainLen < 1 || $domainLen > 255){
					// domain part length exceeded
					$isValid = false;
				}else if ($local[0] == '.' || $local[$localLen-1] == '.'){
					// local part starts or ends with '.'
					$isValid = false;
				}else if (preg_match('/\\.\\./', $local)){
					// local part has two consecutive dots
					$isValid = false;
				}else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)){
					// character not valid in domain part
					$isValid = false;
				}else if (preg_match('/\\.\\./', $domain)){
					// domain part has two consecutive dots
					$isValid = false;
				}else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))){
					// character not valid in local part unless 
					// local part is quoted
					if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local))){
						$isValid = false;
					}
				}
				if ($isValid && !(checkdnsrr($domain,"MX"))){ // changed from if ($isValid && !(checkdnsrr($domain,"MX") || ↪checkdnsrr($domain,"A"))){
					// domain not found in DNS
					$isValid = false;
				}
			}

			// return $isValid; if you want to return the value

			if($isValid == false){
				$this->aErrors[$sControlName] = "* Please use a valid email";
			}



		}
	}

	public function checkConfirmPassword($sControlName1,$sControlName2){
		if($this->checkRequired($sControlName1) == true){
			$sPassword1 = "";
			$sPassword2 = "";

			// trim data
			if(isset($this->aData[$sControlName1])){
				$sPassword1 = trim($this->aData[$sControlName1]);
			}
			// trim data
			if(isset($this->aData[$sControlName2])){
				$sPassword2 = trim($this->aData[$sControlName2]);
			}

			if($sPassword1 !== $sPassword2){
				$this->aErrors[$sControlName2] = "* Passwords do not match";
			}
		}

	}

	public function checkPhone($sControlName){

		if($this->checkRequired($sControlName) == true){
			$sPhone = "";

			// trim data
			if(isset($this->aData[$sControlName])){
				$sPhone = trim($this->aData[$sControlName]);
			}

			if(!preg_match("/^([1]-)?[0-9]{7,13}$/i", $sPhone)) { 
				$this->aErrors[$sControlName] = "* Please use a valid phone number";
			}
		}
	}

	public function checkName($sControlName){

		if($this->checkRequired($sControlName) == true){
			$sName = "";
			// trim data
			if(isset($this->aData[$sControlName])){
				$sName = trim($this->aData[$sControlName]);
			}

			if(!preg_match("/^[\p{L}\p{P}\p{Zs}]+$/", $sName)) { 
				$this->aErrors[$sControlName] = "* Please use alphabetics";
			}

		}

	}

	public function raiseCustomErrors($sControlName,$sErrorMessage){
		// put error into array if there is an error
		$this->aErrors[$sControlName] = $sErrorMessage;
	}

	public function __get($sProperty){
		switch($sProperty){
			case "html":
				return $this->sHTML.'</fieldset></form>';
				break;
			case "valid":
				if(count($this->aErrors) == 0){
					return true;
				}else{
					return false;
				}
				break;
			default:
				die($sProperty." is not allowed to be read from");
		}
	}

	public function __set($sProperty,$value){
		switch($sProperty){
			case "data": // data from post array entered into $this->aData array
				$this->aData = $value;
				break;
			default:
				die($sProperty." is not allowed to write to");
		}
	}

}

?>
<?php

	require_once("db.php");

	class Customer{
		private $iCustomerID;
		private $sFirstName;
		private $sLastName;
		private $sEmail;
		private $sPhone;
		private $sAddress;
		private $sPassword;

		public function __construct(){
			$this->iCustomerID = 0;
			$this->sFirstName = "";
			$this->sLastName = "";
			$this->sEmail = "";
			$this->sPhone = "";
			$this->sAddress = "";
			$this->sPassword = "";
		}

		public function load($iID){
			$oDatabase = new Database();

			$sSQL = "SELECT customerid, firstname, lastname, email, phone, deliveryaddress, password
					FROM tbcustomer
					WHERE customerid =".$iID;
			$bResult = $oDatabase->query($sSQL);
			$aCustomer = $oDatabase->fetch_array($bResult);

			// assign aCustomer array into this objects attributes
			$this->iCustomerID = $aCustomer["customerid"];
			$this->sFirstName = $aCustomer["firstname"];
			$this->sLastName = $aCustomer["lastname"];
			$this->sEmail = $aCustomer["email"];
			$this->sPhone = $aCustomer["phone"];
			$this->sAddress = $aCustomer["deliveryaddress"];
			$this->sPassword = $aCustomer["password"];

			$oDatabase->close();
		}

		public function loadByEmail($sEmail){
			$oDatabase = new Database();
			$sSQL = "SELECT customerid, email
					FROM tbcustomer
					WHERE email = '".$oDatabase->escape_value($sEmail)."'";
			$bResult = $oDatabase->query($sSQL);
			$aArray = $oDatabase->fetch_array($bResult);
			$oDatabase->close();

			if($aArray == false){
				return false;
			}else{
				$this->load($aArray["customerid"]);
				return true;
			}
			
		}

		public function save(){
			$oDatabase = new Database();

			if($this->iCustomerID == 0){

				$sSQL = "INSERT INTO tbcustomer (firstname, lastname, email, phone, deliveryaddress, password)
				VALUES ('".$oDatabase->escape_value($this->sFirstName)."',
					'".$oDatabase->escape_value($this->sLastName)."',
					'".$oDatabase->escape_value($this->sEmail)."',
					'".$oDatabase->escape_value($this->sPhone)."',
					'".$oDatabase->escape_value($this->sAddress)."',
					'".$oDatabase->escape_value($this->sPassword)."')";
			
				// check if data is accepted into database
				$bResult = $oDatabase->query($sSQL);
				if($bResult == true){
					$this->iCustomerID = $oDatabase->get_insert_id(); // insert ID from db into object
				}else{
					die($sSQL." has failed");
				}

			}else{
				//update
				$sSQL = "UPDATE tbcustomer
					SET firstname = '".$oDatabase->escape_value($this->sFirstName)."',
						lastname = '".$oDatabase->escape_value($this->sLastName)."',
						phone = '".$oDatabase->escape_value($this->sPhone)."',
						deliveryaddress = '".$oDatabase->escape_value($this->sAddress)."',
						password = '".$oDatabase->escape_value($this->sPassword)."' 
					WHERE customerid = ".$oDatabase->escape_value($this->iCustomerID);

					$bResult = $oDatabase->query($sSQL);
					if($bResult == false){
						die($sSQL." has failed");
					}
			}

			$oDatabase->close();

		}

		public function __get($sProperty){
			switch($sProperty){
				case "ID":
					return $this->iCustomerID;
				case "firstname":
					return $this->sFirstName;
					break;
				case "lastname":
					return $this->sLastName;
					break;
				case "email":
					return $this->sEmail;
					break;
				case "phone":
					return $this->sPhone;
					break;
				case "address":
					return $this->sAddress;
					break;
				case "password":
					return $this->sPassword;
					break;
				default:
					die($sProperty." is not allowed to be read");
			}
		}

		public function __set($sProperty,$value){

			switch($sProperty){
				case "firstname":
					$this->sFirstName = $value;
					break;
				case "lastname":
					$this->sLastName = $value;
					break;
				case "email":
					$this->sEmail = $value;
					break;
				case "phone":
					$this->sPhone = $value;
					break;
				case "address":
					$this->sAddress = $value;
					break;
				case "password":
					$this->sPassword = $value;
					break;
				default:
					die($sProperty." is not allowed to write to");
			}

		}

	}

	// --- TESTING --- //

	/*
	$oCustomer = new Customer();
	$oCustomer->firstname = "Jono";
	$oCustomer->lastname = "B";
	$oCustomer->email = "jonob@gmail.com";
	$oCustomer->phone = "096783456";
	$oCustomer->address = "62 Giddy St, Remuera, Auckland";
	$oCustomer->password = "12345";

	$oCustomer->save();

	echo "<pre>";
	print_r($oCustomer);
	echo "</pre>";
	*/

	/*
	$oCustomer = new Customer();
	$oCustomer->load(4);

	echo "<pre>";
	print_r($oCustomer);
	echo "</pre>";
	*/

	/*
	$oCustomer = new Customer();
	$oCustomer->loadByEmail("sam.birkhead@gmail.com");
	echo "<pre>";
	print_r($oCustomer);
	echo "</pre>";
	*/

?>
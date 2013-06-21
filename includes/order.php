<?php

require_once("db.php");

class Order{
	private $iOrderID;
	private $dOrderDate;
	private $sOrderStatus;
	private $iCustomerID;
	private $sComments;

	public function __construct(){
		$this->iOrderID = 0;
		$this->dOrderDate = "2013-01-01";
		$this->sOrderStatus = "";
		$this->iCustomerID = 0;
		$this->sComments = "";
	}

	public function save(){
		$oDatabase = new Database();

		$sSQL = "INSERT INTO tborder (orderdate, orderstatus, customerid, comments)
			VALUES ('".$oDatabase->escape_value($this->dOrderDate)."',
			'".$oDatabase->escape_value($this->sOrderStatus)."',
			'".$oDatabase->escape_value($this->iCustomerID)."',
			'".$oDatabase->escape_value($this->sComments)."')";

		$bResult = $oDatabase->query($sSQL);
		if($bResult == true){
			$this->iOrderID = $oDatabase->get_insert_id(); // get orderid from database
		}else{
			die($sSQL." has failed");
		}

		$oDatabase->close();

	}

	public function __set($sProperty,$value){
		switch($sProperty){
			case "date":
				$this->dOrderDate = $value;
				break;
			case "status":
				$this->sOrderStatus = $value;
				break;
			case "customerID":
				$this->iCustomerID = $value;
				break;
			case "comments":
				$this->sComments = $value;
				break;
			default:
				die($sProperty." is not allowed to write to");
		}
	}

}

// --- TESTING --- //

/*
$oOrder = new Order();
$oOrder->date = "2013-07-18";
$oOrder->status = "pending";
$oOrder->customerID = 4;
$oOrder->comments = "testing";

$oOrder->save();

echo "<pre>";
print_r($oOrder);
echo "</pre>";
*/

?>
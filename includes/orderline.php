<?php

require_once("db.php");

class Orderline{
	private $iOrderlineID;
	private $iOrderID;
	private $iProductID;
	private $iQuantity;

	public function __construct(){
		$this->iOrderlineID = 0;
		$this->iOrderID = 0;
		$this->iProductID = 0;
		$this->iQuantity = 0;
	}

	public function save(){
		$oDatabase = new Database();

		$sSQL = "INSERT INTO tborderline (orderid, productid, quantity)
			VALUES ('".$oDatabase->escape_value($this->iOrderID)."',
				'".$oDatabase->escape_value($this->iProductID)."',
				'".$oDatabase->escape_value($this->iQuantity)."')";
		$bResult = $oDatabase->query($sSQL);
		if($bResult == true){
			$this->iOrderlineID = $oDatabase->get_insert_id(); // get orderlineid from db
		}else{
			die($sSQL." has failed");
		}
	}

	public function __set($sProperty,$value){
		switch($sProperty){
			case "orderID":
				$this->iOrderID = $value;
				break;
			case "productID":
				$this->iProductID = $value;
				break;
			case "qty":
				$this->iQuantity = $value;
				break;
			default:
				die($sProperty." is not allowed to write to");
		}
	}
}

// --- TESTING --- //

/*
$oOrderline = new Orderline();
$oOrderline->orderID = 1;
$oOrderline->productID = 5;
$oOrderline->qty = 2;

$oOrderline->save();

echo "<pre>";
print_r($oOrderline);
echo "</pre>";
*/

?>
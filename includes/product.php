<?php

require_once("db.php");

class Product{
	private $iProductID;
	private $iProductTypeID;
	private $fPrice;
	private $iStockLevel;
	private $sPhoto;
	private $sDescription;
	private $sProductName;
	private $iActive;
	private $sSizing;
	private $iDisplayOrder;

	public function __construct(){
		$this->iProductID = 0;
		$this->iProductTypeID = 0;
		$this->fPrice = 0;
		$this->iStockLevel = 0;
		$this->sPhoto = "";
		$this->sDescription = "";
		$this->sProductName = "";
		$this->iActive = 0;
		$this->sSizing = "";
		$this->iDisplayOrder = 0;
	}

	// this function will load a product from the db to php
	// precondition: productID to load must exist
	public function load($iProductID){
		$oDatabase = new Database();

		$sSQL = "SELECT productid, producttypeid, price, stocklevel, photo, description, productname, active, sizing, displayorder
				FROM tbproduct
				WHERE productid = ".$oDatabase->escape_value($iProductID);

		$oResult = $oDatabase->query($sSQL);
		$aProduct = $oDatabase->fetch_array($oResult);

		// assign array result to the product attributes
		$this->iProductID = $aProduct["productid"];
		$this->iProductTypeID = $aProduct["producttypeid"];
		$this->fPrice = $aProduct["price"];
		$this->iStockLevel = $aProduct["stocklevel"];
		$this->sPhoto = $aProduct["photo"];
		$this->sDescription = $aProduct["description"];
		$this->sProductName = $aProduct["productname"];
		$this->iActive = $aProduct["active"];
		$this->sSizing = $aProduct["sizing"];
		$this->iDisplayOrder = $aProduct["displayorder"];

		$oDatabase->close();

	}

	public function save(){
		$oDatabase = new Database();

		$sSQL = "INSERT INTO tbproduct (producttypeid, price, stocklevel, photo, description, productname, active, sizing, displayorder)
		VALUES ('".$oDatabase->escape_value($this->iProductTypeID)."',
			'".$oDatabase->escape_value($this->fPrice)."',
			'".$oDatabase->escape_value($this->iStockLevel)."',
			'".$oDatabase->escape_value($this->sPhoto)."',
			'".$oDatabase->escape_value($this->sDescription)."',
			'".$oDatabase->escape_value($this->sProductName)."',
			'".$oDatabase->escape_value($this->iActive)."',
			'".$oDatabase->escape_value($this->sSizing)."',
			'".$oDatabase->escape_value($this->iDisplayOrder)."',
			)";

		$bResult = $oDatabase->query($sSQL);
		if($bResult == true){
			$this->iProductID = $oDatabase->get_insert_id();
		}else{
			die($sSQL." has failed");
		}
		
		$oDatabase->close();
	}

	public function __get($sProperty){
		switch($sProperty){
			case "ID":
				return $this->iProductID;
				break;
			case "productType":
				return $this->iProductTypeID;
				break;
			case "price":
				return $this->fPrice;
				break;
			case "stockLevel":
				return $this->iStockLevel;
				break;
			case "photo":
				return $this->sPhoto;
				break;
			case "desc":
				return $this->sDescription;
				break;
			case "name":
				return $this->sProductName;
				break;
			case "active":
				return $this->iActive;
				break;
			case "sizing":
				return $this->sSizing;
				break;
			case "dispOrder":
				return $this->iDisplayOrder;
				break;
			default: 
				die($sProperty ."cannot read from");
		}
	}

}


// --- TESTING --- //

/*
$oProduct = new Product();

$oProduct->load(4);

echo "<pre>";
print_r($oProduct);
echo "</pre>";
*/



?>
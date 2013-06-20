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
	private $sColours;
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
		$this->sColours = "";
		$this->sSizing = "";
		$this->iDisplayOrder = 0;
	}

	// this function will load a product from the db to php
	// precondition: productID to load must exist
	public function load($iProductID){
		$oDatabase = new Database();

		$sSQL = "SELECT productid, producttypeid, price, stocklevel, photo, description, productname, active, colours, sizing, displayorder
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
		$this->sColours = $aProduct["colours"];
		$this->sSizing = $aProduct["sizing"];
		$this->iDisplayOrder = $aProduct["displayorder"];

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
			case "colours":
				return $this->sColours;
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
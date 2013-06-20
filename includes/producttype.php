<?php

require_once("product.php");

class ProductType{

	private $iProductTypeID;
	private $sProductTypeName;
	private $sProductTypeDescription;
	private $iDisplayOrder;
	private $aProducts; // array containing product objects

	public function __construct(){
		$this->iProductTypeID = 0;
		$this->sProductTypeName = "";
		$this->sProductTypeDescription = "";
		$this->iDisplayOrder = 0;
		$this->aProducts = array();
	}

	// this function will load a producttype from db to php
	// precondition: producttypeID to load must exist

	public function load($iProductTypeID){
		$oDatabase = new Database();

		$sSQL = "SELECT producttypeid, producttypename, producttypedescription, displayorder
				FROM tbproducttype
				WHERE producttypeid=".$oDatabase->escape_value($iProductTypeID);

		$oResult = $oDatabase->query($sSQL);
		$aProductType = $oDatabase->fetch_array($oResult);

		// assign array values to producttype attributes
		$this->iProductTypeID = $aProductType["producttypeid"];
		$this->sProductTypeName = $aProductType["producttypename"];
		$this->sProductTypeDescription = $aProductType["producttypedescription"];
		$this->iDisplayOrder = $aProductType["displayorder"];


		// load all pages under the producttype

		$sSQL = "SELECT productid
				FROM tbproduct
				WHERE producttypeid=".$oDatabase->escape_value($iProductTypeID)."
				ORDER BY displayorder ASC";

		$oResult = $oDatabase->query($sSQL);

		// for each productid under the producttype, create a new product object
		while($aRow = $oDatabase->fetch_array($oResult)){
			$oProduct = new Product();
			$oProduct->load($aRow["productid"]);
			$this->aProducts[] = $oProduct; // add product object into array
		}

		$oDatabase->close();

	}

	public function __get($sProperty){
		switch($sProperty){
			case "ID":
				return $this->iProductTypeID;
				break;
			case "name":
				return $this->sProductTypeName;
				break;
			case "desc":
				return $this->sProductTypeDescription;
				break;
			case "dispOrder":
				return $this->iDisplayOrder;
				break;
			case "products":
				return $this->aProducts;
				break;
			default: 
				die($sProperty ."cannot read from");
		}
	}

}

// --- TESTING --- //

/*
$oProductType = new ProductType();
$oProductType->load(2);

echo "<pre>";
print_r($oProductType);
echo "</pre>"
*/

?>
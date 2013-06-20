<?php

require_once("db.php");
require_once("product.php");
require_once("producttype.php");

class ProductTypeManager{
	// no attributes

	// function to produce an array of all product types and products
	public function getAllProductTypes(){
		$oDatabase = new Database();

		$sSQL = "SELECT producttypeid FROM tbproducttype";
		$oResult = $oDatabase->query($sSQL);

		// create an array containing all producttypes
		$aAllProductTypes = array();

		while($aRow = $oDatabase->fetch_array($oResult)){
			$oProductType = new ProductType();
			$oProductType->load($aRow["producttypeid"]);
			$aAllProductTypes[] = $oProductType; // adds producttype objects (and product objects) to an array
		}

		$oDatabase->close();

		return $aAllProductTypes;

	}
}

// --- TESTING --- //
/*
$oPTM = new ProductTypeManager();

echo "<pre>";
print_r($oPTM->getAllProductTypes());
echo "</pre>";
*/

?>
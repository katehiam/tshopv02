<?php
	require_once("includes/header.php");
	require_once("includes/catalogueview.php");
	require_once("includes/producttype.php");

	$oCV = new CatalogueView();
	$iCurrentProductTypeID = 0;
	if(isset($_GET[productTypeID])){
		$iCurrentProductTypeID = $_GET[productTypeID];
	}
	$oPT = new ProductType();
	$oPT->load($iCurrentProductTypeID);


	// render out the products on the page
	echo $oCV->render($oPT);
?>
	<div class="clear"></div>
<?php
	require_once("includes/footer.php");
?>
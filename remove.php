<?php

require_once("includes/cart.php");
session_start();

$iProductID = 1;
if(isset($_GET['ID'])){
	$iProductID = $_GET['ID'];
}
$oCart = $_SESSION['cart'];
$oCart->remove($iProductID,1);

// redirect
header("Location:mycart.php");
exit;

?>
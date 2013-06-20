<?php
require_once("includes/cart.php");
session_start();

//$oCart = new Cart;
$iProductID = 1;
if(isset($_GET["ID"])){
	$iProductID = $_GET["ID"];	
}
$oCart = $_SESSION['cart'];
$oCart->add($iProductID ,1);

// redirect
header("Location:mycart.php"); // to change
exit;

?>
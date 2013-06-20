<?php
require_once("includes/cart.php");
session_start();
unset($_SESSION["currentUser"]);
unset($_SESSION["cart"]);
// redirect
header("Location:home.php");
exit;

?>
<?php
require_once("includes/cart.php");
session_start();
require_once("menuview.php");
require_once("producttypemanager.php");
require_once("customer.php");

$oMV=new MenuView();
$oPTM=new ProductTypeManager();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>T Shop</title>
      <link href="assets/styles.css" rel="stylesheet" type="text/css" />
  </head>

  <body>

<div id="container">

	<?php

		if(isset($_SESSION['currentUser'])){
			
			$oCustomer = new Customer();
			$oCustomer->load($_SESSION['currentUser']);
			echo '<p class="logout">Welcome '.$oCustomer->firstname.'! <a href="logout.php">(Log Out)</a></p>';
		}
	?>

	<div id="header">

		<a href="home.php" id="logo">T-Shop.co.nz</a>

		<?php echo $oMV->render($oPTM->getAllProductTypes()); ?>

		<ul id="userNav">

			<li id="loginRegister">
				<?php
				if(!isset($_SESSION['currentUser'])){
					echo '<a href="login.php">LOGIN / REGISTER</a>';
				}
				else{
					echo '<a href="mydetails.php">MY DETAILS</a>';
				}
				?>
			</li>

			<li id="cart">
				<a href="mycart.php">CART</a>
			</li>

		</ul>

		<div class="clear"></div>

	</div>


	<div id="content">
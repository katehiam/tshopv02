<?php
require_once("includes/header.php");
require_once("includes/form.php");
require_once("includes/customer.php");

$oForm = new Form();

if(isset($_POST["submit"])){
	$oTestCustomer = new Customer();
	$bResult = $oTestCustomer->loadByEmail($_POST["email"]);
	if($bResult == false){ // if email does not exist in the db
		$oForm->raiseCustomErrors("email","* Email is incorrect");
	}else{ // if email exists
		if($oTestCustomer->password == $_POST["password"]){ // if passwords match
			
			$_SESSION['currentUser'] = $oTestCustomer->ID;
			$oCart = new Cart();

			$oCart->add(5,1);
			$oCart->add(2,4);
			$oCart->add(9,2);

			$_SESSION['cart'] = $oCart;
			// redirect
			header("Location:mydetails.php");
			exit;

		}else{
			$oForm->raiseCustomErrors("password","* Password is incorrect");
		}
	}
}

$oForm->makeInput("email","Email");
$oForm->makePasswordInput("password","Password");
$oForm->makeSubmit("submit","Login");

?>

<div class="center">

	<h1>Login</h1>

	<?php echo $oForm->html; ?>

	<p><a href="register.php">Not already a member? Register now</a></p>

</div>

<?php
require_once("includes/footer.php");
?>
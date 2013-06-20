<?php
	require_once("includes/header.php");
	require_once("includes/form.php");
	require_once("includes/customer.php");

	$oForm = new Form();


	if(isset($_POST["submit"])){
		$oForm->data = $_POST;
		//$oForm->checkRequired("firstname");
		//$oForm->checkRequired("lastname");
		$oForm->checkRequired("email");
		$oForm->checkRequired("address");
		$oForm->checkRequired("password");

		$oForm->checkEmail("email");
		$oForm->checkConfirmPassword("password","confirmPassword");
		$oForm->checkPhone("phone");
		$oForm->checkName("firstname");
		$oForm->checkName("lastname");


		// check email is unique
		$oTestCustomer = new Customer(); // create a temporary customer that has that email, checks against
		$bResult = $oTestCustomer->loadByEmail($_POST["email"]); // customer exists = true, customer doesnt = false
		if($bResult == true){ // if customer exists 
			$oForm->raiseCustomErrors("email","* Email already taken"); // raise an error for that control
		}

		if($oForm->valid == true){ // if theres no errors
			$oCustomer = new Customer(); // create new customer

			$oCustomer->firstname = $_POST["firstname"];
			$oCustomer->lastname = $_POST["lastname"];
			$oCustomer->email = $_POST["email"];
			$oCustomer->phone = $_POST["phone"];
			$oCustomer->address = $_POST["address"];
			$oCustomer->password = $_POST["password"];
			$oCustomer->save();

			// redirect
			header("Location:login.php"); // tweak the output_buffering in php.ini
			exit;
		}

	}
	

	$oForm->makeInput("firstname","First name");
	$oForm->makeInput("lastname","Last Name");
	$oForm->makeInput("email","Email");
	$oForm->makeInput("phone","Phone");
	$oForm->makeTextArea("address","Address");
	$oForm->makePasswordInput("password","Password");
	$oForm->makeConfirmPasswordInput("confirmPassword","Confirm Password");
	$oForm->makeSubmit("submit","Register");


?>
	<div class="center">
		<h1>Register</h1>
		
		<?php 
			echo $oForm->html;
		?>

	<p><a href="login.php">Already a member? Login now</a></p>
	</div>


<?php
	require_once("includes/footer.php");
?>
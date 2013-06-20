<?php
require_once("includes/header.php");
require_once("includes/customerview.php");
require_once("includes/customer.php");

// if user isn't logged on
if(!isset($_SESSION['currentUser'])){
	// redirect
	header("Location:login.php");
	exit;
}


$oCV = new CustomerView();
$oUser = new Customer();
$oUser->load($_SESSION['currentUser']);
?>
<div class="center">
	<h1>My Details</h1>

	<?php echo $oCV->render($oUser); ?>
	<p><a href="editdetails.php">Edit my details</a></p>
</div>

<?php
require_once("includes/footer.php");
?>
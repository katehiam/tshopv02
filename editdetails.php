<?php
require_once("includes/header.php");
require_once("includes/form.php");
require_once("includes/customer.php");

$oForm = new Form();
$oUser = new Customer();
$oUser->load($_SESSION['currentUser']);

$aData = array();
$aData["firstname"] = $oUser->firstname;
$aData["lastname"] = $oUser->lastname;
$aData["phone"] = $oUser->phone;
$aData["address"] = $oUser->address;

$oForm->data = $aData;

if(isset($_POST["submit"])){
	// update
	$oForm->checkRequired("address");
	$oForm->checkPhone("phone");
	$oForm->checkName("firstname");
	$oForm->checkName("lastname");

	if($oForm->valid == true){

		$oUser->firstname = $_POST["firstname"];
		$oUser->lastname = $_POST["lastname"];
		$oUser->phone = $_POST["phone"];
		$oUser->address = $_POST["address"];

		$oUser->save();

		//redirect
		header("Location:mydetails.php"); // tweak the output_buffering in php.ini
		exit;
	}
}

$oForm->makeInput("firstname","First Name");
$oForm->makeInput("lastname","Last Name");
$oForm->makeInput("phone","Phone");
$oForm->makeTextArea("address","Delivery Address");
$oForm->makeSubmit("submit","Update");

?>

<div class="center">
	<h1>Edit My Details</h1>
	<?php echo $oForm->html; ?>
</div>

<?php
require_once("includes/footer.php");
?>
<?php
	require_once("includes/header.php");
	require_once("includes/cartview.php");
	require_once("includes/product.php");
	require_once("includes/form.php");

	// if user isn't logged on
	if(!isset($_SESSION['currentUser'])){
	// redirect
	header("Location:login.php");
	exit;
	}

	$oCV = new CartView();

	$oCart = ($_SESSION['cart']);

	$oForm = new Form();
	$oForm->makeTextArea("ordercomments","Comments");

?>
	
<div id="ordercontainer">

		<?php echo $oCV->render($oCart); ?>

		<div id="ordercomments">
			<?php echo $oForm->html; ?>
		</div>
	</div>
</div>

<?php
	require_once("includes/footer.php");
?>
<?php

class CartView{

	public function render($oCart){

		$sHTML = '';
		$grandTotal = 0;

		$sHTML .= '<h1>Place Order</h1>

	<div id="order">
	<h2>Order Summary</h2>
	<hr />
	<ul id="cartlist">';
		foreach($oCart->contents as $key => $value){
			$oProduct = new Product();
			$oProduct->load($key);

			$sHTML .= '<li> <span class="cartproduct">'.$oProduct->name.'</span> 
				<span class="product_qty">x '.$value.'</span>
				<a href="remove.php?ID='.$oProduct->ID.'">(remove)</a>  
				<span class="product_price"><span class="product_price_number">$'.number_format(($oProduct->price)*$value,2).'</span></span>
				
			</li>';
			$grandTotal += ($oProduct->price)*$value;
		}



	$sHTML .= '</ul>

	<br/>

	<hr/>

	<p id="totalprice">Total: $'.number_format($grandTotal,2).'</p>
	<br />
	
	';

		return $sHTML;
	}

}

?>
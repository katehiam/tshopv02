<?php

class Cart{
	private $aContents;

	public function __construct(){
		$this->aContents = array();
	}	

	public function add($iProductID,$iQuantity){

		if(!isset($this->aContents[$iProductID])){

			$this->aContents[$iProductID] = $iQuantity;

		}else{

			$this->aContents[$iProductID] += $iQuantity;
		}
	}

	public function remove($iProductID,$iQuantity){

			$this->aContents[$iProductID] -= $iQuantity;

			//if the product quantity is zero in cart, remove item form cart
			if($this->aContents[$iProductID] <= 0)
				unset($this->aContents[$iProductID]);
	}

	public function __get($sProperty){
		switch($sProperty){
			case "contents";
				return $this->aContents;
				break;

		}
	}
}

// --- TESTING --- //

/*
$oCart = new Cart();
$oCart->add(10,1);
$oCart->add(10,6);
$oCart->add(12,1);
$oCart->remove(12,1);
$oCart->remove(10,5);
$oCart->remove(12,1);

echo "<pre>";
print_r($oCart);
echo "</pre>";
*/
?>

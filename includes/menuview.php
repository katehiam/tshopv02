<?php

class MenuView{
	public function render($aAllProductTypes){

		$sHTML = '';
		$sHTML .='<ul id="productNav">';

		for($iCount=0;$iCount<count($aAllProductTypes);$iCount++){
			$oCurrentProductType = $aAllProductTypes[$iCount];

			$sHTML .='<li>
			<a href="catalogue.php?productTypeID='.$oCurrentProductType->ID.'">'.$oCurrentProductType->name.'</a>
			</li>';
		}

		$sHTML .='</ul>';

		return $sHTML;
			
	}

}



?>



<?php

class CustomerView{

	public function render($oUser){
		$sHTML = '';

		$sHTML .= '<ul class="details">
			<li>
				<span class="label">First Name</span>
				<span class="detail">'.$oUser->firstname.'</span>
			</li>
			<li>
				<span class="label">Last Name</span>
				<span class="detail">'.$oUser->lastname.'</span>
			</li>
			<li>
				<span class="label">Email Name</span>
				<span class="detail">'.$oUser->email.'</span>
			</li>
			<li>
				<span class="label">Phone</span>
				<span class="detail">'.$oUser->phone.'</span>
			</li>
			<li>
				<span class="label">Delivery Address</span>
				<span class="detail">'.$oUser->address.'</span>
			</li>
		</ul>';

		return $sHTML;
	}

}

?>
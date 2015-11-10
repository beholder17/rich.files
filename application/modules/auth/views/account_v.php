<?php
	if ($this->uri->segment(1)=='ru') {
		$lang_header = 'Личный кабинет покупателя';
		$lang_orders = 'Мои заказы';
		$lang_profile = 'Анкета';
	}
	if ($this->uri->segment(1)=='en') {
		$lang_header = 'My Account';
		$lang_orders = 'My orders';
		$lang_profile = 'My profile';
	}
?>
<h1 class='lined'><span><?=$lang_header?></span></h1>
<ul>
	<li><a href='account/orders'><?=$lang_orders?></a></li>
	<li><a href='account/userinfo'><?=$lang_profile?></a></li>
</ul>
<?php
//print_r($user_orders);
?>

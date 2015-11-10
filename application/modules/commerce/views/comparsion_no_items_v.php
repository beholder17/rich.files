<?php
	if ($this->uri->segment(1)=='en') {
		$lang_title = 'No items to compare';
		$lang_back =  'Go back';
	}
	if ($this->uri->segment(1)=='ru') {
		$lang_title = 'Нет товаров для сравнения';
		$lang_back =  'Вернуться назад';
	}
?>
<h1><?=$lang_title?></h1>
<a href='javascript:window.history.back()'><i class="fa fa-arrow-left"></i> <?=$lang_back?></a>
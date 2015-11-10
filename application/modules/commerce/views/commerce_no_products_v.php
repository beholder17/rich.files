<?php
	if ($this->uri->segment(1)=='en') {
		$lang_back =  'Go back';
	}
	if ($this->uri->segment(1)=='ru') {
		$lang_back =  'Вернуться назад';
	}
?>
<h1><?php
if ($this->uri->segment(1)=='ru') echo 'К сожалению, в данной категории пока нет товаров';
if ($this->uri->segment(1)=='en') echo 'Unfortunately, in this category yet no items';
?></h1>
<a href='javascript:window.history.back()'><i class="fa fa-arrow-left"></i> <?=$lang_back?></a>




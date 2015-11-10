<?php
	if ($this->uri->segment(1)=='en') {
		$lang_title = 'Password successfully changed!';
		$lang_text1 = 'Your password was successfully changed.';
		$lang_text2 = 'Use it to login';
	}
	if ($this->uri->segment(1)=='ru') {
		$lang_title = 'Пароль успешно изменен!';
		$lang_text1 = 'Ваш пароль успешно изменен. Используйте его, чтобы ';
		$lang_text2 = 'авторизоваться на сайте';
		
	}
?>
<h1><?=$lang_title?></h1>
<p><?=$lang_text1?><a href='<?=base_url().$this->uri->segment(1)?>/auth/login'><?=$lang_text2?></a></p>
<?php
	if ($this->uri->segment(1)=='en') {
		$lang_title = 'Enter your new password';
		$lang_new_password = 'New password';
		$lang_new_password_twice = 'New password again';
	}
	if ($this->uri->segment(1)=='ru') {
		$lang_title = 'Укажите ваш новый пароль';
		$lang_new_password = 'Новый пароль';
		$lang_new_password_twice = 'Новый пароль повторно';
		
	}
?>
<h1><?=$lang_title?></h1>
<form method='post' id='form_new_password' action='<?= base_url().$this->uri->segment(1)?>/auth/new_password'>
	<p><input class='custom_input' type='password' name='password' placeholder='<?=$lang_new_password?>'></p><?=  form_error('password'); ?>
	<p><input class='custom_input' type='password' name='password2' placeholder='<?=$lang_new_password_twice?>'></p><?=  form_error('password2'); ?>
	<input type='hidden' name='hash' value='<?=$hash?>'>
	<p><input class='btn_v2' type='submit' name='new_pw_submit'></p>
</form>
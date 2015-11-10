<?php
	if ($this->uri->segment(1)=='en') {
		$lang_title = 'Password recovery';
		$lang_descr = 'Enter yours e-mail address, that you used for registration, and instructions to reset your password will be sent to this e-mail.';
		$lang_yours_email = 'Yours E-mail';
		$lang_btn_value = 'Recover';
	}
	if ($this->uri->segment(1)=='ru') {
		$lang_title = 'Восстановление пароля';
		$lang_descr = 'Укажите адрес эл. почты, который вы использовали при регистрации, и инструкции по смене пароля будут высланы на этот адрес.';	
		$lang_yours_email = 'Ваш E-mail';
		$lang_btn_value = 'Восстановить';
	}
?>
<h1><?=$lang_title?></h1>
<p>
<?=$lang_descr;?>
</p>
<form method='post' action='forget'>
	<p><label for='email'><?=$lang_yours_email?>: </label><input class='custom_input' name='email' type='text' value=''>
	<?=  form_error('email'); ?>
	</p>
	<input class='btn_v2' name='submit' type='submit' value='<?=$lang_btn_value?>'>
</form>
<?php
//set_value('email')
?>
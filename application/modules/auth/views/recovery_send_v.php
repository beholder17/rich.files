<?php
	if ($this->uri->segment(1)=='en') {
		$lang_title = 'Password recovery';
		$lang_text = 'Check your email. How to recover password have been sent there.';
	}
	if ($this->uri->segment(1)=='ru') {
		$lang_title = 'Восстановление пароля';
		$lang_text = 'Проверьте вашу электронную почту. Инструкции по восстановлению пароля были отправлена туда.';
	}
?>
<h1><?=$lang_title?></h1>
<p>
	<?=$lang_text?>
</p>
<?php $this->lang->load('contacts', $this->uri->segment(1)); ?>
<h1><?= $this->lang->line('contacts');?></h1>
<div class='contacts_text'>
<?php 
$text_ru = "Адрес: 344000, г. Ростов-на-Дону,<br>
пр. Шолохова 310 “А”,<br>
пав. № 10,<br><br>
Рынок “Классик” пав. № 125 и № 175,<br>

<i class='fa fa-phone'></i> 8 (908) 177 93 99,<br>
<i class='fa fa-phone'></i> 8 (918) 518 00 22<br>
<i class='fa fa-phone'></i> 8 (863) 241 56 90<br>
<br>

Режим работы: с 8:00 до 17:00<br><br>
<h1>Реквизиты</h1>
Счет №40802810252094083817<br>
ИП Мохамад Самиулла Захир<br>
";

$text_en = "Location: 344000, c. Rostov-on-Don,<br>
pr. Sholokhov's 310 “А”,<br>
pav. № 10,<br><br>
Market “Classic” pav. № 125 и № 175<br>

<i class='fa fa-phone'></i> 8 (908) 177 93 99,<br>
<i class='fa fa-phone'></i> 8 (918) 518 00 22<br>";
if ($this->uri->segment(1)=='tr') echo $text_tr;
if ($this->uri->segment(1)=='en') echo $text_en;
if ($this->uri->segment(1)=='ru') echo $text_ru;
?>
</div>
<div class='map_block'>
<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=0s3MS_ODBtKyrdktGAiTyPfwW0pdMcaq&height=400"></script>
</div>

<div class="h2_cover">
<h2 class="h2_alt"><?= $this->lang->line('form_caption');?></h2>
</div>
<form id='contacts' method='post' action=''>
	<p><label for='name'><?= $this->lang->line('contacts_form_name');?></label><input value='<?=set_value('name')?>' type='text' name='name' id='' placeholder='Ваше имя'><?=form_error('name'); ?></p>
	<p><label for='email'><?= $this->lang->line('contacts_form_phone_mail');?></label><input value='<?=set_value('email')?>' type='text' name='email' id='' placeholder='Ваши контакты, чтобы мы могли ответить Вам'><?=form_error('email'); ?></p>
	<p><label for='theme'><?= $this->lang->line('contacts_form_theme');?></label><input value='<?=set_value('theme')?>' type='text' name='theme' id='' placeholder='Тема сообщения'><?=form_error('theme')?></p>
	<p><label for='msg'><?= $this->lang->line('contacts_form_text');?></label><textarea name='msg'><?=set_value('msg')?></textarea><?=form_error('msg'); ?></p>
	<p><input class='btn_v2'type='submit' name='submit_contacts' id='' placeholder='placeholdr' value='<?= $this->lang->line('contacts_form_submit');?>'></p>
	<p><input type="checkbox" checked="checked" name='send_me'/><span style='position: relative; left: -116px;'><?= $this->lang->line('contacts_form_send_copy');?></span></p>
	<p><label for='captcha'><?= $this->lang->line('contacts_form_captcha');?></label><input type='text' name='captcha' id='' placeholder='Введите код с картинки'><?=form_error('captcha')?></p>
	<p style='position: relative; left: 31%; '><?php echo $image;?></p>
	<input type='hidden' name='captcha_hidden' value="<?=$random_string_for_captcha?>">

</form>
<?php
	if ($this->uri->segment(1)=='en'){
		$lang_title = 'Add review';
		$lang_txt1 = 'E-mail address will not be published or available to third parties. It will be used to respond to your message. It is not a mandatory field';
		$lang_txt2 = 'Review will be published after moderation';
	}
	if ($this->uri->segment(1)=='ru'){
		$lang_title = 'Добавить отзыв';
		$lang_txt1 = 'Адрес электронной почты не будет опубликован или доступен третьим лицам. Он будет использован для ответа на ваше сообщение. Не является обязательным полем';
		$lang_txt2 = 'Отзыв будет опубликован после модерации';
	}
?>
<h1 class='lined'><span><?=$lang_title?></span></h1>
<form action="add_review" method="post" name="add_review" id="add_review" enctype="multipart/form-data">
    <p><label for="name">Your name </label><input class='custom_input' type="text" name="name" size="50" value="<?=isset($form_data['name'])?>"><?= form_error('name');?></p>
    <p><label for="fulltext">Review </label><br><textarea class='custom_input txtarea' name="fulltext" rows="10" cols="62"><?=isset($form_data['fulltext'])?></textarea><?= form_error('fulltext');?></p>
	<p><label for="city">Where you from? </label><input class='custom_input' type="text" name="city" size="50" id="" value="<?=isset($form_data['city'])?>"><?= form_error('city');?></p>
    <p><label for="email">Your e-mail </label><input class='custom_input' type="text" name="email" size="50" id="add_review_email" value="<?=isset($form_data['email'])?>"><?= form_error('email');?></p>
	<p><label for="userfile">Photo </label><input type="file" name="userfile" size="50" id="add_review_userfile"></p>
	<div style='text-align: center'>
    <input type="submit" value="Отправить отзыв" name="add" class="btn_v2">
	</div>
</form>
<p><?=$lang_txt1?></p>
<p><?=$lang_txt2?></p>

<? //print_r($form_data);?>

<style>
    .add_review_email
    {
        color: #790228;
        border-radius: 5px;
        border: 1px solid #D0D0D0;
        padding: 5px;
        width: 220px;
    }
	#add_review label{
	width: 123px;
    display: inline-block;
	text-align: right;
	padding-right: 5px;
	}
	
	.txtarea{
	position: relative;
    left: 128px;
    top: -17px;
	}
</style>

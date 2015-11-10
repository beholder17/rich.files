<?php
	$this->lang->load('auth', $this->uri->segment(1));
	if ($this->uri->segment(1)=='ru'){
		$lang_title = 'Личный кабинет покупателя';
		$lang_h2 = "Анкета";
		$lang_txt = "Вы можете откорректировать контактные данные, если они изменились или были указаны неверно.";
		$lang_change = "Изменить контактную информацию";
	}
	
	if ($this->uri->segment(1)=='en'){
		$lang_title = "My profile";
		$lang_h2 = "User's info";
		$lang_txt = "You can adjust the contact information, if it have been changed or are incorrect.";
		$lang_change = "To change";
	}
?>

<h1 class='lined'><span><?=$lang_title?></span></h1>
<h2><?=$lang_h2?></h2>
<form id='info_change_form' method='post' enctype='multipart/form-data' action="<?=base_url().$this->uri->segment(1);?>/auth/update_user_info">
	<p>ID: <?=$user_info[0]['id'];?></p>
	<p><?=$this->lang->line('name')?>: <?=$user_info[0]['name'];?></p>
	<p><?=$this->lang->line('famil')?>: <?=$user_info[0]['famil'];?></p>	
	<p><?=$this->lang->line('registration_date')?>: <?=date('d.m.Y',$user_info[0]['date_registration']);?></p>	
	
	<p><?=$lang_txt?></p>
	
	<p><label for='email'><?=$this->lang->line('mail')?>: </label><input class='custom_input' name='email' type='text' value='<?=$user_info[0]['email'];?>'></p>
	<p><label for='adress'><?=$this->lang->line('address')?>: </label><input class='custom_input' name='adress' type='text' value='<?=$user_info[0]['adress'];?>'></p>
	<p><label for='phone'><?=$this->lang->line('ph_phone')?>: </label><input class='custom_input' name='phone' type='text' value='<?=$user_info[0]['phone'];?>'></p>
	<?php 
	if ($user_info[0]['avatar'] != ''){
		echo "<div style='text-align: center'>";
		echo "<img class='img_circle' src='".base_url().'assets/avatars/'.$user_info[0]['avatar']."'>";
		echo "</div>";
	}
	?>
	<p><label for='userfile'><?=$this->lang->line('avatar')?>: </label><input class='custom_input1' name='userfile' type='file'></p>
	<input type='hidden' value='<?=$user_info[0]['id']?>' name='id'>
	<div style='text-align: center'>
	<input class='btn_v2' type='submit' name='send' value='<?=$lang_change?>'>
	</div>
</form>





<?php //var_dump($user_info); ?>
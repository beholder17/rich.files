<?php $this->lang->load('auth', $this->uri->segment(1)); ?>
<script src="<?= base_url()?>template/js/jquery.maskedinput.min.js" type="text/javascript"></script>


<h1 class='lined'><span><?=$this->lang->line('registration');?></span></h1>
<form id='reg_form' method='POST' action='<?= base_url().$this->uri->segment(1);?>/auth/registration'>
	<p><label for='name'><?=$this->lang->line('name');?></label>
	<input type='text' size='80' name='name' id='' placeholder='<?=$this->lang->line('ph_name');?>' value='<?= set_value('name')?>'>
	<?= form_error('name');?>
	</p>
	<p><label for='surname'><?=$this->lang->line('famil');?></label>
	<input type='text' size='80' name='surname' id='' placeholder='<?=$this->lang->line('ph_famil');?>' value='<?= set_value('surname')?>'>
	<?= form_error('surname');?>
	</p>
	<p><label for='phone'><?=$this->lang->line('phone');?></label>
	<input type='text' size='80' name='phone' id='phone' placeholder='<?=$this->lang->line('ph_phone');?>' value='<?= set_value('phone')?>'>
	<?= form_error('phone');?>
	</p>
	<p><label for='city'><?=$this->lang->line('address');?></label>
	<input type='text' size='80' name='city' id='' placeholder='<?=$this->lang->line('ph_address');?>' value='<?= set_value('city')?>'>
	<?= form_error('city');?>
	</p>
	<p><label for='email'><?=$this->lang->line('mail');?></label>
	<input type='text' size='80' name='email' id='' placeholder='<?=$this->lang->line('ph_email');?>' value='<?= set_value('email')?>'>
	<?= form_error('email');?>
	</p>
	<p><label for='pw'><?=$this->lang->line('password');?></label>
	<input type='password' size='80' name='pw' id='' placeholder='<?=$this->lang->line('ph_pw');?>' value='<?= set_value('pw')?>'>
	<?= form_error('pw');?>
	</p>
	<p><label for='pw2'><?=$this->lang->line('password_again');?></label>
	<input type='password' size='80' name='pw2' id='' placeholder='<?=$this->lang->line('ph_pw_again');?>' value='<?= set_value('pw2')?>'>
	<?= form_error('pw2');?>
	</p>
	<p><label for='captcha_auth'><?=$this->lang->line('captcha');?></label><input id='captcha_auth' name='captcha_auth' id="captcha_frm" type="text" size="30" placeholder="<?=$this->lang->line('ph_captcha');?>"><?= form_error('captcha_auth');?></p>
	<p style='position: relative; left: 136px;'><?php echo $image;?></p>
	<input style='position: relative; left: 136px;' class='btn_v2' name='registration_button' type='submit' value='<?=$this->lang->line('to_register');?>'>
</form>
<script>
jQuery(function($){
   $("#phone").mask("9 (999) 999-99-99",{placeholder:"_ (___) ___-__-__"});
});
</script>


<?php $this->lang->load('commerce', $this->uri->segment(1)); ?>
<h1 class='lined'><span><?=$this->lang->line('to_checkout')?></span></h1>
<form method='post' action='<?= base_url().$this->uri->segment(1);?>/commerce/checkout_send'>
	<p><?=$this->lang->line('contacts')?>:</p>
	<ul>
	<li><?=$this->lang->line('name')?>: <?=$user_informer[0]['name'];?> <?=$user_informer[0]['famil'];?></li>
	<li><?=$this->lang->line('phone')?>: <?=$user_informer[0]['phone'];?></li>
	<li><?=$this->lang->line('address')?>: <?=$user_informer[0]['adress'];?></li>
	<li><?=$this->lang->line('email')?>: <?=$user_informer[0]['email'];?></li>
	</ul>
	

	<p>
	<strong><span><?=$user_informer[0]['name'].' '.$user_informer[0]['famil']?></span></strong>, <?=$this->lang->line('msg1')?>:<br>
	<strong><?= $user_informer[0]['adress'] ?></strong>
	</p>
	

	<p style='color: #E23956'>
		<?=$this->lang->line('msg2')?>
	</p>
	
	<?=$this->lang->line('comment_if_needed')?>
	
	<textarea name='comment' class='text_area'></textarea>

	<input class='btn_v2' value='<?=$this->lang->line('send_an_order')?>' type='submit'>
</form>
<? var_dump($cart)?>
<?php
//$tmp = $this->session->userdata();
//echo "<pre>";
//print_r($userdata['cart_contents']);
?>
<style>
.text_area{
    padding: 0;
    outline: none;
    background-color: white;
    resize: none;
	width: 98%;
	height: 250px;
}
</style>
<style>
.hidden{
	display: none;
}
.content_container{
	height: 310px;
}
</style>
<?php
	if ($this->uri->segment(1)=='ru') {
		$lang_title = 'Отправлено';
		$lang_text = 'Ваше сообщение было успешно отправлено менеджерам сайта richworld-st.ru. В ближайшее время Вами будет получен ответ!';
		$lang_text2 = 'Спасибо за интерес, проявленный к нашей продукции!'; 
		$lang_go_back = 'Назад';
	}
		if ($this->uri->segment(1)=='en') {
		$lang_title = 'Submitted';
		$lang_text = 'Your message has been sent to the site managers richworld-st.ru. In the near future you will get an answer!';
		$lang_text2 = 'Thank you for your interest in our products!'; 
		$lang_go_back = 'Go back';
	}
?>
<h1 class='lined'><span><?=$lang_title?></span></h1>
<p><?=$lang_text?></p>
<h2 style='text-align: center'><?=$lang_text2?></h2>
<br>

<div style='text-align: center'>
	<a href='<?=base_url().$this->uri->segment(1).'/contacts'?>'><i class="fa fa-arrow-left"></i> <?=$lang_go_back?></a>
</div>

<div style='text-align: center' class='animated hidden'>
<img src='<?=base_url()?>template/img/mail_convert.jpg'>
</div>
<script>
setTimeout(function(){
	 $('.animated').viewportChecker({
			classToAdd: 'fadeInUp', // Class to add to the elements when they are visible
			classToRemove: 'hidden', // Class to remove before adding 'classToAdd' to the elements
			repeat: true // Add the possibility to remove the class if the elements are not visible
		});
}, 500);

      
</script>
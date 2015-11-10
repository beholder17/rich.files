<?php

	//set language variables
	if ($this->uri->segment(1)=='en'){
		$description = $category_info[0]['description_tr'];
		$title = $category_info[0]['name'];
		$current_lang = 'en';
	}
	if ($this->uri->segment(1)=='ru'){
		$description = $category_info[0]['description'];
		$title = $category_info[0]['name'];
		$current_lang = 'ru';
	}
$this->lang->load('commerce',$current_lang);
?>
<h1 class='lined'><span><?=$title?></span></h1>
<?php if ($title == 'Rich World') echo modules::run('slider/index','main');?>
<p style='text-indent: 20px'><?=$description?></p>
<h2 class='lined'><span><?=$this->lang->line('we_offer_products')?></span></h2>
<div class='catalog_item_badge gel_growup product_item'>
	<?php $link = base_url().$this->uri->segment(1).'/catalog/'.$category_info[0]['alias'].'/geli-dlya-narashivaniya-nogtei';?>
	<a href='<?=$link?>'></a>
	<div class='title'><a href='<?=$link?>'><?=$this->lang->line('Gels_for_nails_build_up')?></a></div>
</div>
<div class='catalog_item_badge bafs product_item'>
	<?php $link = base_url().$this->uri->segment(1).'/catalog/'.$category_info[0]['alias'].'/bafy';?>
	<a href='<?=$link?>'></a>
	<div class='title'><a href='<?=$link?>'><?=$this->lang->line('buffs')?></a></div>
</div>
<div class='catalog_item_badge boards product_item'>
	<?php $link = base_url().$this->uri->segment(1).'/catalog/'.$category_info[0]['alias'].'/pilki';?>
	<a href='<?=$link?>'></a>
	<div class='title'><a href='<?=$link?>'><?=$this->lang->line('emery_boards')?></a></div>
</div>
<div class='catalog_item_badge brushes product_item'>
	<?php $link = base_url().$this->uri->segment(1).'/catalog/'.$category_info[0]['alias'].'/kisti-dlya-gelya';?>
	<a href='<?=$link?>'></a>
	<div class='title'><a href='<?=$link?>'><?=$this->lang->line('brush_the_gel')?></a></div>
</div>
<div class='catalog_item_badge paraffin product_item'>
	<?php $link = base_url().$this->uri->segment(1).'/catalog/'.$category_info[0]['alias'].'/parafinoterapiya';?>
	<a href='<?=$link?>'></a>
	<div class='title'><a href='<?=$link?>'><?=$this->lang->line('paraffin')?></a></div>
</div>
<div class='catalog_item_badge primer product_item'>
	<?php $link = base_url().$this->uri->segment(1).'/catalog/'.$category_info[0]['alias'].'/praymery';?>
	<a href='<?=$link?>'></a>
	<div class='title'><a href='<?=$link?>'><?=$this->lang->line('primers')?></a></div>
</div>
<div class='catalog_item_badge shines_dust product_item'>
	<?php $link = base_url().$this->uri->segment(1).'/catalog/'.$category_info[0]['alias'].'/blestki-i-pyl';?>
	<a href='<?=$link?>'></a>
	<div class='title'><a href='<?=$link?>'><?=$this->lang->line('sequins_and_dust')?></a></div>
</div>
<div class='catalog_item_badge straz product_item'>
	<?php $link = base_url().$this->uri->segment(1).'/catalog/'.$category_info[0]['alias'].'/strazy';?>
	<a href='<?=$link?>'></a>
	<div class='title'><a href='<?=$link?>'><?=$this->lang->line('rhinestones')?></a></div>
</div>
<div class='catalog_item_badge uv_lamp product_item'>
	<?php $link = base_url().$this->uri->segment(1).'/catalog/'.$category_info[0]['alias'].'/uf-lampy';?>
	<a href='<?=$link?>'></a>
	<div class='title'><a href='<?=$link?>'><?=$this->lang->line('uv_lamps')?></a></div>
</div>
<h2 class='lined'><span><?=$this->lang->line('and_other_stuff')?></span></h2>
<ul>
<?php
$except_list = array('1','13','12','9','27','8','19','21','2');
foreach ($subcategory as $item)
{
	
	if (!in_array($item['id'],$except_list)){
		$link = base_url().$this->uri->segment(1).'/catalog/'.$category_info[0]['alias'].'/'.$item['alias'];
		echo "<li><a href='".$link."'>";
		if ($current_lang == 'ru') echo $item['name'];
		if ($current_lang == 'en') echo $item['name_tr'];
		echo "</a></li>";
	}
	
}
?>
</ul>
<?php 
if ($current_lang == 'ru') echo "<p>Приобретая продукцию ".$category_info[0]['name']." в нашем интернет-магазине вы получаете высокий уровень сервиса, продукцию гарантированно высокого качества. Доставка осуществляется удобной Вам транспортной компанией в максимально сжатые сроки.</p>";
if ($current_lang == 'en') echo "<p>By investing ".$category_info[0]['name']." in our online store, you get a high level of service, high quality products guaranteed. Shipping is convenient to you a transport company as soon as possible.</p>";
?>


<?php
//var_dump($subcategory);
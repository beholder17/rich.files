<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Админка</title>
	<META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
	<link href="<?= base_url().'template/bootstrap/'?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
	
	<link href="<?= base_url().'template/'?>css/animate.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url().'template/admin/'?>css/admin_style.css" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Scada&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>template/js/jquery.json.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>template/js/jquery.serializejson.min.js"></script>
	
	<script type="text/javascript" src="<?= base_url()?>template/ckeditor/ckeditor.js"></script>
	
	<script type="text/javascript" src="<?= base_url()?>/template/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
	<link href="<?= base_url().'template/jquery-ui-1.11.4.custom/'?>jquery-ui.css" rel="stylesheet" type="text/css">
	
	
	<link href="<?= base_url().'template/admin/'?>css/admin_style.css" rel="stylesheet" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	

	
</head>
	<body>
		<div class='logo'>Rich World : Интернет магазин</div>
		<div>
			<div class='sidebar'>
				<ul>
					<li style='margin-bottom: 7px; !important'><a href='<?= base_url(); ?>'><i class="icon-home icon-white"></i> На сайт</a></li>
					
					<li><a id='categories' href='javascript: void(0)'><i class="icon-tag icon-white"></i> Категории</a></li>
					<li><a id='subcategories' href='javascript: void(0)'><i class="icon-tags icon-white"></i> Подкатегории</a></li>
					<li><a id='add_product' href='javascript: void(0)'><i class="icon-plus icon-white"></i> Добавить товар</a></li>
					<li style='margin-bottom: 7px; !important'><a id='show_products' href='javascript: void(0)'><i class="icon-th-list icon-white"></i> Все товары</a></li>
					<!--<li><a id='products' href='javascript: void(0)'>Товары</a></li>-->
					
					<li><a id='content_category' href='javascript: void(0)' title='Для добавления категорий контента. В последующем добавленные категории следует привязывать к конкретным материалам. Например, чтобы написать новость, системе нужно указать что введенный вами материал является Новостью, а не Страницей'><i class=" icon-th-large icon-white"></i> Категории контента</a></li>
					<li style='margin-bottom: 7px; !important'><a id='add_content' href='javascript: void(0)'><i class="icon-plus icon-white"></i> Добавить контент</a></li>
					<!--<li><a id='content_mngr' href='javascript: void(0)'>Контент</a></li>-->
					
					
					<li style='margin-bottom: 7px; !important'><a id='add_slider' href='javascript: void(0)'><i class="icon-picture icon-white"></i> Добавить слайдер</a></li>
					
					<li style='margin-bottom: 7px; !important'><a id='adm_reviews' href='javascript: void(0)'><i class="icon-pencil icon-white"></i> Отзывы</a></li>
					<li><a id='adm_orders' href='javascript: void(0)'><i class="icon-shopping-cart icon-white"></i> Заказы</a></li>
					
					 
				</ul>
				
			</div>
			<div class='content_my'>
				
				<?php if (isset($content)) echo $content;?>
				
			</div>
			
		</div>

    <script>
	//$(function() {$( document ).tooltip();});
	function waiting()
	{
		 $('div.content_my').html('<div class="waiting" style="opacity: 0.1; position: relative;">Waiting</div>');
		 $('div.waiting').animate({opacity: 1}, 900);
	}
	
	function show() {
		$('div.content_page').addClass('animated zoomIn'); 
		//$('.sidebar').addClass('animated zoomIn'); 
		//alert('1');
		
		}
	
            $(document).ready(function(){
				$('.sidebar ul li a').click(function(){
					$f = $(this).parent().addClass('animated bounceIn');
					setTimeout(function(){$f.removeClass('animated bounceIn');
					}, 500);
				});
				
			
				$('a#subcategories').click(function(){
				waiting();
				$('div.content_my').load('<?=base_url();?>admin/subcategory',function(){show()}); 
				});
				
				$('a#products').click(function(){ 
				waiting();
				$('div.content_my').load('<?=base_url();?>admin/products',function(){show()}); 
				});
				
				$('a#categories').click(function(){ 
				waiting(); 
				$('div.content_my').load('<?=base_url();?>admin/category',function(){show()}); 
				});
				
				$('a#content_category').click(function(){ 
				waiting(); 
				$('div.content_my').load('<?=base_url();?>admin/content_category',function(){show()}); 
				});
				
				$('a#content_mngr').click(function(){ 
				waiting(); 
				$('div.content_my').load('<?=base_url();?>admin/content_manager',function(){show()}); 
				});
				
				$('a#add_content').click(function(){ 
				waiting(); 
				$('div.content_my').load('<?=base_url();?>admin/add_content',function(){show()}); 
				});
				
				$('a#add_product').click(function(){ 
				waiting(); 
				$('div.content_my').load('<?=base_url();?>admin/add_product',function(){show()}); 
				});
				
				$('a#add_slider').click(function(){ 
				waiting(); 
				$('div.content_my').load('<?=base_url();?>admin/add_slider',function(){show()}); 
				});
				
				$('a#adm_reviews').click(function(){ 
				waiting(); 
				$('div.content_my').load('<?=base_url();?>reviews/adm_reviews',function(){show()}); 
				});
				
				$('a#adm_orders').click(function(){ 
				waiting(); 
				$('div.content_my').load('<?=base_url();?>commerce/adm_orders/unpaid',function(){show()}); 
				});
				
				$('a#show_products').click(function(){ 
				waiting(); 
				$('div.content_my').load('<?=base_url();?>commerce/show_products',function(){show()}); 
				});
				
				
				
				
				
                                         
                                        }
                            ); 
          </script>
	</body>
	
</html>

<?php $this->lang->load('main_menu', $this->uri->segment(1)); 
if ($this->uri->segment(1)=='ru') $current_lang = 'ru';
if ($this->uri->segment(1)=='en') $current_lang = 'en';

function rebuilt($massive)
{
	
	$result = array();
	foreach ($massive as $item)
	{
		if ($item['parent']==NULL) $parent_index = 0; else $parent_index=$item['parent'];
        $result[$parent_index][] =  $item;
	}
	
	return $result;
}

function built_to_tree($array,$parent_id,$segment,$segment3,$segment4,$category_alias)
{
	
	if(is_array($array) and isset($array[$parent_id])>0){
		$tree = "<!--<div class='roll_trigger'><i class='fa fa-angle-right'></i></div>--><ul class='ul_class_".$category_alias."'><div id='nothing_found'></div>";
		foreach($array[$parent_id] as $item)
		{			
			$link = base_url().$segment.'/catalog/'.$category_alias.'/'.$item['alias'];
			$link_to_compare = base_url().$segment.'/catalog/'.$segment3.'/'.$segment4;
			if ($link_to_compare==$link) $current_marker = 'class="active"'; else $current_marker='';			
			if ($segment=='ru') {
				$name = $item['name'];
			}
			if ($segment=='en') {
				$name = $item['name_tr'];
			}
			$link = base_url().$segment.'/catalog/'.$category_alias.'/'.$item['alias'];
			$tree .= "<li ".$current_marker."><a href='$link'>".$name."</a>";
			$tree .=  built_to_tree($array,$item['id'],$segment,$segment3,$segment4,$category_alias);
			$tree .= '</li>';         
		}
		$tree .= '</ul>';
	}
	else return null;      

	return $tree; 
}
?>
<!DOCTYPE html>
<html lang="<?=$current_lang?>">
<head>
<link href="<?= base_url();?>template/css/custom_styles.css" rel="stylesheet" type="text/css">
	<!--[if lt IE 9]>
    <script src="<?= base_url();?>template/js/html5.js"></script>
	<![endif]-->
	<title><?= $seo_title ?></title>
	<meta http-equiv="Cache-Control" content="public"/>
	<meta name="keywords" content="<?= $seo_keywords ?>"/>
	<meta name="description" content="<?= $seo_description ?>"/>
	<meta name="robots" content="<?php if (isset($seo_index)) {if ($seo_index == '0') echo 'noindex,nofollow'; else echo 'index,follow';} else echo 'index,follow';?>">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	
	<link href="<?= base_url();?>template/css/basic_styles.css" rel="stylesheet" type="text/css"> 
	
	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->
	
	<script src="<?= base_url();?>template/js/jquery1-7_2.min.js" type="text/javascript"></script>
	<script src="<?= base_url();?>template/js/zurb.js" type="text/javascript"></script>
	<!--<script src="<?= base_url();?>template/js/jquery.viewportchecker.min.js" type="text/javascript"></script>-->
	<link href="<?= base_url();?>template/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> 
</head>
<body>
	<div id="pagewrap">
		<header id="header">
		<div id='header_phone'>+7 (863) 241-56-90</div>
		<div class='auth_block'>
			<?= $auth_form; ?>
		</div>
		
		<!--<div class='lang_switcher'>
			<p>ЯЗЫК</p>
			<a id='ru' href='#'></a>
			<a id='en' href='#'></a>
		</div>-->

		<?php echo modules::run('lang/switcher','main'); ?>
		<div class='shopping_cart'>
			<div class='shopping_cart_counter'>
				<div class='shopping_cart_counter_container'><?= $this->cart->total_items(); ?></div>
			</div>
			
			<div class='shopping_cart_informer'>
				<a href='<?= base_url().$this->uri->segment(1);?>/commerce/cart'><?= $this->lang->line('cart_term1');?> <span><?= $this->cart->total_items(); ?></span> <?= $this->lang->line('cart_term2');?></a>
			</div>
		</div>
		</header>
		 <nav>
			<div class='navigation_trigger'></div>
			 <ul id="main_nav">
				<li><a <?php //if ($this->uri->segment(2)==NULL) echo "class='active'";?> <?php if ( $this->uri->segment(2)==NULL) echo "class='active border_radius_left'"; ?> href="<?=base_url().$this->uri->segment(1)?>"><?= $this->lang->line('home');?></a></li>
				<li><a <?php if (stripos(uri_string(), 'news')==4) echo "class='active'"; ?> href="<?=base_url().$this->uri->segment(1)?>/news/"><?= $this->lang->line('news');?></a></li>
				<li><a <?php if (stripos(uri_string(), 'about')==4) echo "class='active'"; ?> href="<?=base_url().$this->uri->segment(1)?>/about"><?= $this->lang->line('about');?></a></li>
				<li><a <?php if (stripos(uri_string(), 'opt')==4) echo "class='active'"; ?> href="<?=base_url().$this->uri->segment(1)?>/opt"><?= $this->lang->line('wholesale');?></a></li>
				<li><a <?php if (stripos(uri_string(), 'payment-and-delivery')==4) echo "class='active'"; ?> href="<?=base_url().$this->uri->segment(1)?>/payment-and-delivery"><?= $this->lang->line('delivery_pay');?></a></li>
				<li><a <?php if (stripos(uri_string(), 'reviews')==4) echo "class='active'"; ?> href="<?=base_url().$this->uri->segment(1)?>/reviews"><?= $this->lang->line('reviews');?></a></li>
				<li><a <?php if (stripos(uri_string(), 'contacts')==4) echo "class='active'"; ?> href="<?=base_url().$this->uri->segment(1)?>/contacts/"><?= $this->lang->line('contacts_b');?></a></li>
			 </ul>
		  </nav>
		  <?php $this->benchmark->mark('code_start');?>
		<aside id="sidebar">
			<div id='logo_block'>
				<a href='<?= base_url().$this->uri->segment(1)?>'></a>
			</div>
		  <div class='side_menu'>
		  <!--quick-filter-->
			<form>
				<input type='text' id='quick_filter' value='' placeholder='Быстрый поиск по категориям...'>
			</form>
			
			<style>
				#quick_filter{
					border: 2px solid #972448;
					width: 86%;
					padding: 4px;
					margin: -3px 0px 5px 0px;
					color: #7C082D;
					background-color: #F2F2F2;
					border-radius: 4px;
					outline: none;
					font-family: 'PT Sans', sans-serif;					
					font-style: italic;				
				}
				#quick_filter::-webkit-input-placeholder {
				text-decoration: italic
				}
			</style>
			<a id='novelty' href='<?= base_url().$this->uri->segment(1)?>/commerce/novelty'><?= $this->lang->line('novelty');?></a>
			<div class='rich_world_products_btn'>Rich World</div>
			
			<?=built_to_tree(rebuilt($subcategory),0,$this->uri->segment(1),$this->uri->segment(3),$this->uri->segment(4),'rich-world');?>
			
			<!--<ul class='rich_world_products_list'>
			
				<?php 
				/*foreach ($subcategory as $item){
				if ($this->uri->segment(1)=='en') $subcat_name = $item['name_tr'];
				if ($this->uri->segment(1)=='ru') $subcat_name = $item['name'];
				$link = base_url().$this->uri->segment(1).'/catalog/rich-world/'.$item['alias'];
				$link_to_compare = base_url().$this->uri->segment(1).'/catalog/'.$this->uri->segment(3).'/'.$this->uri->segment(4);
				if ($link_to_compare==$link) $current_marker = 'class="active"'; else $current_marker='';
				
				?>
				
				<li <?=$current_marker?>><a href='<?=$link?>'><?= $subcat_name ?></a>
				<?php 
				//if ()
				?>
				</li>
				<?php }*/ ?>
			</ul>-->
			<a id='partners' href='javascript:void(0)'><?= $this->lang->line('partners');?></a>
			<ul id='partners_list'>
			<?php foreach ($category as $item): if ($item['name']=='Rich World') continue;?>
				<li class='partner_item'><p><?= $item['name']?></p>
					<!--<ul>
					<?php /*foreach ($subcategory as $item_sc){
						if ($this->uri->segment(1)=='en') $subcat_name = $item_sc['name_tr'];
						if ($this->uri->segment(1)=='ru') $subcat_name = $item_sc['name'];
						$link = base_url().$this->uri->segment(1).'/catalog/'.$item['alias'].'/'.$item_sc['alias'];						
						$link_to_compare = base_url().$this->uri->segment(1).'/catalog/'.$this->uri->segment(3).'/'.$this->uri->segment(4);
						if ($link_to_compare==$link) $current_marker = 'class="active"'; else $current_marker='';
						?>
						
					<li <?=$current_marker?>><a href='<?=$link?>'><?= $subcat_name;?></a></li>
					<?php }*/?>
					</ul>-->
					<?=built_to_tree(rebuilt($subcategory),0,$this->uri->segment(1),$this->uri->segment(3),$this->uri->segment(4),$item['alias']);?>
				</li>
			<?php endforeach?>
	
			</ul>
			
			<?php echo modules::run('commerce/block_recommended_slider','8'); ?>
		  </div>
		  
		</aside>  
		<?php $this->benchmark->mark('code_end');?>
		<div id="content">		
			<div class='search_form'>
				<form method='post' action='<?= base_url()?><?= $this->uri->segment(1);?>/search'>
					<div class='search_form_lense'></div>
					<input placeholder='<?= $this->lang->line('search_placeholder');?>' name='search_text' id='search_text' type='text' value='<?php if (isset($search_text)) echo $search_text;?>' size='40'>
					<input name='search_btn' id='search_btn' type='submit' value='<?= $this->lang->line('search');?>'>
				</form>
			</div>
			<div style='position: relative; top: 15px;'>
				<?php if (current_url()==base_url().'index.php/en' OR current_url()==base_url().'index.php/tr' OR current_url()==base_url().'index.php/ru') echo "<div class='promo_link'>
					<a href='".base_url().$this->uri->segment(1)."/commerce/promo'></a>
				</div>" ?>
				
				<?php if (current_url()==base_url().'index.php/en' OR current_url()==base_url().'index.php/tr' OR current_url()==base_url().'index.php/ru') 
					echo modules::run('slider/index','main'); ?>
				
			</div>
			<?php if (current_url()==base_url().'index.php/en' OR current_url()==base_url().'index.php/tr' OR current_url()==base_url().'index.php/ru') echo modules::run('commerce/block_recommended','12'); ?>
			<div class='content_container' <?php if ( $this->uri->segment(1)==NULL) echo "content_container_void"?>>
			<?php if (isset($breadcrumbs)) echo "<div class='breadcrumbs'>".$breadcrumbs."</div>";?>
			<?php if (isset($block_news)) echo $block_news; ?>
			<?php if (isset($contacts)) echo $contacts; ?>
			<?php if (isset($content)) echo $content; ?>
			</div>
			
		  
		
		</div>
		
		<footer id="footer">
		<div class="phone_number_footer">+7 (863) 241-56-90</div>
		<ul class="menu_footer">			
			<li class=""><a href="<?=base_url().$this->uri->segment(1)?>/payment-and-delivery" class=""><?= $this->lang->line('delivery_pay');?></a></li>
			<li class=""><a href="<?=base_url().$this->uri->segment(1)?>/contacts" class=""><?= $this->lang->line('contacts_b');?></a></li>
			<li class=""><a href="<?=base_url().$this->uri->segment(1)?>/commerce/cart" class=""><?= $this->lang->line('cart');?></a></li>
			<li class='metric_img'>
				<a href="https://metrika.yandex.ru/stat/?id=32751865&amp;from=informer"target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/32751865/3_0_FFFFFFFF_FFFFFFFF_0_pageviews"style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:32751865,lang:'ru'});return false}catch(e){}" /></a>
			</li>
		</ul>
		<ul class='social_links'>
			<li class='vk'><a href='#'></a></li>
			<li class='fb'><a href='#'></a></li>
			<li class='in'><a href='#'></a></li>
			<li class='ok'><a href='#'></a></li>
		</ul>
		<div class='copyright'>
			<div class='appico_img'></div>Appico &copy; 2015
		</div>
		</footer>
	</div>
<script>
(function(){
var widget_id = 776807;
_shcp =[{widget_id : widget_id}];
var lang =(navigator.language || navigator.systemLanguage 
|| navigator.userLanguage ||"en")
.substr(0,2).toLowerCase();
var url ="widget.siteheart.com/widget/sh/"+ widget_id +"/"+ lang +"/widget.js";
var hcc = document.createElement("script");
hcc.type ="text/javascript";
hcc.async =true;
hcc.src =("https:"== document.location.protocol ?"https":"http")
+"://"+ url;
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hcc, s.nextSibling);
})();
</script>
	
	
	<!--<link href="<?= base_url();?>template/css/animate.css" rel="stylesheet" type="text/css">-->
	
	<link href="<?= base_url();?>template/css/media_queries.css" rel="stylesheet" type="text/css">
	<script src="<?= base_url();?>template/js/css3-mediaqueries.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="<?= base_url();?>template/js/sidemenu.js"></script>-->
	
	<script type="text/javascript" src="<?= base_url()?>/template/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>/template/js/jquery.jcarousel.min.js"></script>
	
	<link href="<?= base_url().'template/jquery-ui-1.11.4.custom/'?>jquery-ui.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url().'template/jquery-ui-1.11.4.custom/'?>theme_custom.css" rel="stylesheet" type="text/css">
	
	
	<script type="text/javascript" src="<?= base_url()?>template/js/jquery.json.min.js"></script>
	<script type="text/javascript" src="<?= base_url()?>template/js/jquery.serializejson.min.js"></script>	
	<!-- Yandex.Metrika informer --><!-- /Yandex.Metrika informer --> <!-- Yandex.Metrika counter --><script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter32751865 = new Ya.Metrika({ id:32751865, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="https://mc.yandex.ru/watch/32751865" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>
<?php //echo $this->benchmark->elapsed_time('code_start', 'code_end').'<br>';?>

<!--{elapsed_time}-->

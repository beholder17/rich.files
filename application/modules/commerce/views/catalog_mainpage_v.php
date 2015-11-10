<?php

	//set language variables
	if ($this->uri->segment(1)=='en'){
		//$description = $category_info[0]['description_tr'];
		$title = "Catalog";
		$current_lang = 'en';
	}
	if ($this->uri->segment(1)=='ru'){
		//$description = $category_info[0]['description'];
		$title = "Каталог";
		$current_lang = 'ru';
	}
$this->lang->load('commerce',$current_lang);
?>
<h1 class='lined'><span><?=$title?></span></h1>
<ul class='catalog_mainpage'>
<?php 
function crop_str($string, $limit)  
{
$substring_limited = substr($string,0, $limit);        //режем строку от 0 до limit
return substr($substring_limited, 0, strrpos($substring_limited, ' ' ));    //берем часть обрезанной строки от 0 до последнего пробела
}
foreach ($category as $item)
{	if ($current_lang == 'ru') $description = crop_str($item['description'],600).'...';
	if ($current_lang == 'en') $description = crop_str($item['description_tr'],600).'...';
	$link = base_url().$this->uri->segment(1).'/catalog/'.$item['alias'];
	echo "<li>";	
	echo "<a href='".$link."'>";
	?>
	<img style='width: 200px' src='<?=$item['image']?>'>
	<h3><?=$item['name']?></h3>
	<p><?=$description?></p>
	
	
	
	<?php
	echo "</a>";
	
	echo "</li>";
	
}
?>
</ul>

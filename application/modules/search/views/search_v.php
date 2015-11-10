<?php $this->lang->load('main_menu', $this->uri->segment(1)); ?>
<h1><?= $this->lang->line('search');?></h1>

<p><?= $this->lang->line('search_results');?></p>
<?php 
//echo $pager;
//http://rich_t.ru/catalog/rich-world/gel-laki/183
foreach ($result['result'] as $key=>$value)
{
	if ($value['tablename']=='c_products') {
	echo "<div class='search_type_c_products'>";
	echo "<a href='".base_url()."catalog/".$value['category']."/".$value['show']."/".$value['alias']."'>".$value['title']."</a>"; 
	echo "</div>";
	}
	
	if ($value['tablename']=='content') { 
	echo "<div class='search_type_content'>";
	echo "<a href='".base_url()."news/".$value['alias']."'>".$value['title']."</a>"; 
	echo "</div>";
	}
	
	
}
//echo $pager;
//print_r($result);
//print_r($result['query']);
?>


<?php
	/*if ($this->uri->segment(1)=='ru'){
		$this->load->library-
		$lang_title = 'Сравнение товаров';
		$lang_name = 'Сравнение товаров';
		$lang_price = 'Сравнение товаров';
		$lang_category = 'Категория';
		$lang_subcategory = 'Категория';
		$lang_sku = 'Категория';
		$lang_value = 'Категория';
	}*/
?>
<h1 class='lined'><span>Сравнение товаров</span></h1>
<?php
function get_thumb($val)
{
	$path_info = pathinfo($val);
	return $path_info['filename'].'_thumb.'.$path_info['extension'];
}
	
if ($this->uri->segment(1)=='en') {$currency = ' USD'; $currency_sql = 'price-usd';}
if ($this->uri->segment(1)=='tr') {$currency = ' TRY'; $currency_sql = 'price-try';}
if ($this->uri->segment(1)=='ru') {$currency = ' РУБ'; $currency_sql = 'price-rub';}
$link = base_url().$this->uri->segment(1).'/commerce/comparsion_del';
?>
<table class='comparsion_table'>
<tr><td class='f_td'>Фото</td><?php foreach ($comparsion_items as $value){echo "<td><a href=\"".base_url().'catalog/'.$value[0]['category_alias']."/".$value[0]['subcategory_alias']."/".$value[0]['id']."\"><img src='".base_url()."assets/img/products/thumbs/".get_thumb($value[0]['image'])."'><div class='comparsion_remove'><a class='comparsion_remove' href='".$link."/".$value[0]['id']."'>Убрать из сравнения</a></div></td>";} ?></tr>
<?php if ($comparsion_items[0][0]['name']!=NULL){?><tr><td>Наименование</td><?php foreach ($comparsion_items as $value){echo "<td>".$value[0]['name']."</td>";} ?></tr><?php }?>
<?php if ($comparsion_items[0][0][$currency_sql]!=NULL){?><tr><td>Цена</td><?php foreach ($comparsion_items as $value){echo "<td>".$value[0]['price-rub']." ".$currency."</td>";} ?></tr><?php }?>
<?php if ($comparsion_items[0][0]['category']!=NULL){?><tr><td>Категория</td><?php foreach ($comparsion_items as $value){echo "<td>".$value[0]['category']."</td>";} ?></tr><?php }?>
<?php if ($comparsion_items[0][0]['subcategory']!=NULL){?><tr><td>Подкатегория</td><?php foreach ($comparsion_items as $value){echo "<td>".$value[0]['subcategory']."</td>";} ?></tr><?php }?>
<?php if ($comparsion_items[0][0]['sku']!=NULL){?><tr><td>Артикул</td><?php foreach ($comparsion_items as $value){echo "<td>".$value[0]['sku']."</td>";} ?></tr><?php }?>
<?php if ($comparsion_items[0][0]['volume']!=NULL){?><tr><td>Объём</td><?php foreach ($comparsion_items as $value){echo "<td>".$value[0]['volume']."</td>";} ?></tr><?php }?>
<?php if ($comparsion_items[0][0]['width']!=NULL){?><tr><td>Ширина</td><?php foreach ($comparsion_items as $value){echo "<td>".$value[0]['width']."</td>";} ?></tr><?php }?>
<?php if ($comparsion_items[0][0]['height']!=NULL){?><tr><td>Высота</td><?php foreach ($comparsion_items as $value){echo "<td>".$value[0]['height']."</td>";} ?></tr><?php }?>
<?php if ($comparsion_items[0][0]['thickness']!=NULL){?><tr><td>Толщина</td><?php foreach ($comparsion_items as $value){echo "<td>".$value[0]['thickness']."</td>";} ?></tr><?php }?>
<?php if ($comparsion_items[0][0]['weight']!=NULL){?><tr><td>Вес</td><?php foreach ($comparsion_items as $value){echo "<td>".$value[0]['weight']."</td>";} ?></tr><?php }?>
<?php if ($comparsion_items[0][0]['material']!=NULL){?><tr><td>Материал</td><?php foreach ($comparsion_items as $value){echo "<td>".$value[0]['material']."</td>";} ?></tr><?php }?>
<?php if ($comparsion_items[0][0]['abrasiveness']!=NULL){?><tr><td>Абразивность</td><?php foreach ($comparsion_items as $value){echo "<td>".$value[0]['abrasiveness']."</td>";} ?></tr><?php }?>
</table>
<?php //var_dump($comparsion_items);?>
<style>
.stolp1,.stolp2{float: left}
td {
	border: 1px dotted gray;
}
.f_td{
	text-align: center;
}
</style>
<?php //var_dump($info);?>
<?php $this->lang->load('commerce', $this->uri->segment(1)); ?>

<?php
$count_items=0;
foreach ($info as $key=>$value){
	$count_items++;
	// get thumbnail file name
	$path_info = pathinfo($value['image']);
	$value['image'] = $path_info['filename'].'_thumb.'.$path_info['extension'];
	$link = base_url().$this->uri->segment(1).'/catalog/'.$category_alias.'/'.$subcategory_alias.'/'.$value['id'];
?>

<div class='product_item' id='<?= $value['id']?>'>
<div class='product_item_image'><a href="<?=$link?>"><img src='<?= base_url(); ?>assets/img/products/thumbs/<?= $value['image'] ?>'></a></div>
<div class='product_item_name'><a href='<?=$link?>'><?php
if ($this->uri->segment(1)=='tr') echo $value['name_tr']; else echo $value['name'];
?></a></div>
<div class='product_item_price'><?php 
if ($this->uri->segment(1)=='en') echo '$ '.$value['price-usd'];
if ($this->uri->segment(1)=='ru') echo $value['price-rub'].' &#8399;';
if ($this->uri->segment(1)=='tr') echo $value['price-try'].' ?';
?></div>
<div class='product_item_buy
<?php 
$at_cart = array_keys($cart);
$count = count($cart);
$output_txt = "";
for ($i = 0; $i < $count; $i++)
{
	if ($cart[$at_cart[$i]]['id'] == $value['id']) {$output_txt = "at_cart"; 
	$tmp = true;
	continue;
	}
}
echo $output_txt;
?>
'>

<?php 
$at_cart = array_keys($cart);
$count = count($cart);
$output_txt = $this->lang->line('catalog_add_to_cart');
for ($i = 0; $i < $count; $i++)
{
	if ($cart[$at_cart[$i]]['id'] == $value['id']) {$output_txt = $this->lang->line('already_at_cart');
	$tmp = true;
	continue;
	}
}
echo $output_txt;
?>
<input type='hidden' value="<?= $value['id'] ?>">
</div>

<?php if ($this->session->userdata('level')=='99') { ?>
<a class='edit_item_link' href='<?= base_url();?>admin/edit_product/<?= $value['id'] ?>'>Edit</a>
<?php }?>

<div class='comparsion' id='c_<?= $value['id'] ?>'><?= $this->lang->line('add_to_comparsion');?></div>
</div>

	
<?php	
$link = base_url().$this->uri->segment(1)."/commerce/promo/".$category_id.'/'.$subcategory_id;
if ($count_items==2) {echo "<div class='product_item' id=''><div class='to_see_all_novelties'><a href='$link'>Смотреть все новинки</a></div></div>"; 
break;
}

}?>
<style>
.to_see_all_novelties{
	font-size: 20px;
	line-height: 200px;
	text-align: center;
	cursor: pointer;
}
</style>
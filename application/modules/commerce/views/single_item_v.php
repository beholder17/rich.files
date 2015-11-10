<?php //var_dump($value);
$link = base_url().$this->uri->segment(1).'/catalog/'.$value['category_alias'].'/'.$value['subcategory_alias'].'/'.$value['id'];
//$link ='';
?>
<?php
// get thumbnail file name
$path_info = pathinfo($value['image']);
$value['image'] = $path_info['filename'].'_thumb.'.$path_info['extension'];
?>

<div class='product_item' id='<?= $value['id']?>'>
<div class='product_item_image'><a href="<?=$link?>"><img src='<?= base_url(); ?>assets/img/products/thumbs/<?= $value['image'] ?>'></a></div>
<div class='product_item_name'><a href='<?=$link?>'><?php
if ($this->uri->segment(1)=='en') echo $value['name_tr']; 
if ($this->uri->segment(1)=='ru') echo $value['name'];
 
?></a></div>
<div class='product_item_price'><?php 
if ($this->uri->segment(1)=='en') {echo '$ '.$value['price-usd']; $by = 'by';}
if ($this->uri->segment(1)=='ru') {echo $value['price-rub'].' &#8399;'; $by = 'от';}
if ($this->uri->segment(1)=='tr') {echo $value['price-try'].' £'; $by = 'by';}
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

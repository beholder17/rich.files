<?php $this->lang->load('commerce', $this->uri->segment(1)); ?>
<h1 class='lined'><span><?= $this->lang->line('cart_title');?></span></h1>

<p>
<?php //var_dump ($multi_currency);
if (count ($multi_currency)>1) {
	$multi_currency_cart = true;
	echo "Мультивалютная корзина!";
$link = base_url().$this->uri->segment(1).'/commerce/cart/';
foreach ($multi_currency as $value)
	{
		if ($value == 'en') $set_currency = "USD";
		if ($value == 'tr') $set_currency = "TRY";
		if ($value == 'ru') $set_currency = "RUB";
		echo "<p><a href='".$link."$value'>".$set_currency."</a></p>";
	}
} else $multi_currency_cart = false;


?>

</p>

<form id='cart_form' method='post' action='<?= base_url().$this->uri->segment(1);?>/commerce/cart_calculate'>
<table class='cart_table'>
	<tr class='cart_table_head'>
		<td><?= $this->lang->line('cart_img');?></td>
		<td id='td_cart_descr'><?= $this->lang->line('cart_descr');?></td>
		<td><?= $this->lang->line('cart_qty');?></td>
		<td><?= $this->lang->line('cart_price_per_item');?></td>
		<td style='width: 90px;'><?= $this->lang->line('cart_sum_per_item');?></td>
		<td class='td_remove'><?= $this->lang->line('cart_remove');?></td>		
	</tr>
	
	<?php 
	$iteration = 0;
	foreach ($cart as $value){ 
	$iteration++;
	$descr_of_product = " ".$value['sku']." ".$value['category_alias'];
	?>
	<tr class='cart_table_row' id='<?= $iteration; ?>'>
		<td class='td_preview_img cart_table_center'><div class='thumb_cart_container'><a href='<?= base_url();?>catalog/<?= $value['category_alias'].'/'.$value['subcategory_alias'].'/'.$value['id']; ?>'><img title='<?=$descr_of_product?>' class='cart_preview' src='<?= base_url();?>assets/img/products/thumbs/<?= $value['image']; ?>'></a></div></td>
		<td class='td_cart_descr'><a href='<?= base_url().$this->uri->segment(1);?>/catalog/<?= $value['category_alias'].'/'.$value['subcategory_alias'].'/'.$value['id']; ?>'><?php 
		//if ($this->uri->segment(1)=='en') echo $value['name'];
		if ($this->uri->segment(1)=='ru') echo $value['name'];
		if ($this->uri->segment(1)=='en') echo $value['name_tr']; ?></a></td>
		<td class='cart_table_center'>
		<input name='qty_<?= $iteration; ?>' class='qty_container' title="Количество" type="text" value="<?= $value['qty']; ?>" size="4" maxlength="4" class="form-text">
		<input name='rowid_<?= $iteration; ?>' value='<?= $value['rowid']; ?>' type='hidden'>
		</td>
		<td class='cart_table_center'><?php 
		if ($value['currency']=='en') echo "$ ".$value['price'];
		if ($value['currency']=='tr') echo $value['price']." £";
		if ($value['currency']=='ru') echo $value['price']." &#8399;";
		 ?></td>
		<td class='cart_table_center'><?php $sum = $value['price'] * $value['qty'];
		if ($value['currency']=='en') echo "$ ".$sum;
		if ($value['currency']=='tr') echo $sum." £";
		if ($value['currency']=='ru') echo $sum." &#8399;";
		?></td>
		<td class='cart_table_center'><div class='remove_from_cart' id='<?= $value['rowid']; ?>'><a id='<?= $value['id']; ?>' href='javascript: void(0)'><img title='Удалить' src='<?= base_url();?>template/img/del_cross.png'></div></td>		
	</tr>
	<?php $total = $value['subtotal'];?>
	<?php } ?>
</table>
<div class='cart_total'>
	<!--<div class='rebuilt_cart'>Пересчитать</div>-->
	<?= $this->lang->line('cart_total');?> - <?= $this->cart->total_items().' '.$this->lang->line('pcs');?><br><?php echo $this->lang->line('total').' - '.$this->cart->total(); ?>
	<?php
	if ($multi_currency['0']=='ru') echo " &#8399;";
	if ($multi_currency['0']=='en') echo " $";
	if ($multi_currency['0']=='tr') echo " £";
	?>
</div>
<div class='buttons_row'>
	<div class='cart_drop btn_v2 constant_width'><i class="fa fa-trash-o"></i> <?= $this->lang->line('cart_drop');?></div>
	<input class='btn_v2 constant_width' name='cart_calculate' value='<?= $this->lang->line('cart_recalc');?>' type='submit'>
	<a class='btn_v2 constant_width' href='<?=base_url().$this->uri->segment(1)?>/catalog/rich-world/geli-dlya-narashivaniya-nogtei'><?=$this->lang->line('continue_shopping')?></a>
</div>

<div class='make_order_btn_area'>
<?php 	//print_r ($this->session->userdata('id')); 
if ($multi_currency_cart == false){
	if ($this->session->userdata('id')!=NULL) 
		echo "<a class='checkout btn_v2 constant_width' href='".base_url().$this->uri->segment(1)."/commerce/checkout'><i class='fa fa-shopping-cart'></i> ".$this->lang->line('cart_checkout')."</a>"; else {echo "<a class='checkout btn_v2 constant_width' href='".base_url().$this->uri->segment(1)."/auth/login'>"."<i class='fa fa-shopping-cart'></i> ".$this->lang->line('cart_checkout')."</a>";

?>

<?php
}} else echo "Чтобы продолжить оформление заказа, выберите валюту";

//var_dump($cart);
?>
</div>
<br><br>
<?php if ($this->session->userdata('level')<1) {?>
<p style='text-align: center'><?=$this->lang->line('to_order_you must');?></p>
<?php }?>
<?php //var_dump ($cart);?>



</form>
<br><br><br><br><br><br><br><br>
<?php 

//print_r($this); ?>

<script>
$(function() {
    $( document ).tooltip();
  });
	    $(document).ready(function(){
                $('.remove_from_cart').click(function(){
					
					$id = $(this).children().attr('id');
					$rowid = $(this).attr('id');
					//$qty = $(this).parent().prev().prev().children().val();
					
					//alert($id+' - '+$rowid+' - '+$qty);
					var form_data = {
					"id":$id,
					"rowid":$rowid,
					"qty":'0',
			        };
					
						$.ajax({
						dataType: 'text',
						type:'POST',
						data:'json_data=' + $.toJSON(form_data),
						url: '<?= base_url();?>en/commerce/cart_remove_item',
						success: function($ret){
						//reload();
						//alert('в корзине');
						location.reload();
						/*$shopping_cart_items = parseInt($('.shopping_cart_informer a span').html());						
						$shopping_cart_items = $shopping_cart_items+1;
						$('.shopping_cart_informer a span').html($shopping_cart_items);
						$('.shopping_cart_counter_container').html($shopping_cart_items);
						*/
						//$('#'+$id+' .product_item_image').appendTo('#logo_block');
						},
						error: function($exception){
							alert('error!');
							alert('Exeption:'+$exception);
						},
						done: function(){
							alert('done!');			
							alert('Exeption:'+$exception);
						}
						});
				})
				
				$('.cart_drop').click(function(){
						$.ajax({
						dataType: 'text',
						type:'POST',
						data:'json_data=drop',
						url: '<?= base_url();?>en/commerce/cart_drop',
						success: function($ret){
						location.reload();
						},
						error: function($exception){
							alert('error!');
							alert('Exeption:'+$exception);
						},
						done: function(){
							alert('done!');			
							alert('Exeption:'+$exception);
						}
						});
				})
				
				
				})
</script>





<style>

</style>
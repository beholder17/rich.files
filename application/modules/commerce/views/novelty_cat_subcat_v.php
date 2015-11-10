<?php $this->lang->load('commerce', $this->uri->segment(1)); ?>
<?php
	if ($this->uri->segment(1)=='en') {
		$title = 'Novelties';
		$description = $category[0]['description_tr'];
	}
	if ($this->uri->segment(1)=='ru') {
		$title = 'Новинки';
		$description = $category[0]['description'];
	}
?>
<h1><?= $title.' '.$category[0]['name']?></h1>
<h2><?php 
if ($this->uri->segment(1)=='ru') echo $subcategory[0]['name'];
if ($this->uri->segment(1)=='en') echo $subcategory[0]['name_tr'];
?></h2>
<?php //var_dump ($novelties);?>
<?php //var_dump ($category);?>
<?php 
foreach ($novelties as $value)
{
	?>

	<?php 
	$data['value'] = $value;
	$this->load->view('single_item_v',$data);
	//$link = base_url().$this->uri->segment(1)."/commerce/novelty/".$category_id.'/'.$subcategory_id;
	
}
?>


<div style='clear: both'></div>
<p><?=$description?></p>

<script>
	    $(document).ready(function(){
                $('.product_item_buy').click(function(){					
					if (!$(this).hasClass('at_cart')) {
					$id = $(this).children().attr('value');
					$img_name = $(this).parent().children().children().children();					
					$img = $img_name[0]['currentSrc'];
					//alert($id);
						$.ajax({
						dataType: 'text',
						type:'POST',
						data:'json_data='+$id,
						url: '<?= base_url().$this->uri->segment(1);?>/commerce/add_to_cart',
						success: function($ret){
						//reload();
						//alert('в корзине');
						$('#'+$id+' .product_item_buy').html('В корзине');
						$offset = $('#'+$id+' .product_item_image img').offset();
						$offset_cart = $('.shopping_cart_informer').offset();
						$left = $offset.left;//+0.5;
						$top = $offset.top;//+0.5;
						//alert($left+' - '+$top);
						//$('#'+$id+' .product_item_image').eq(0).clone();
						$('body').append('<img style="z-index: 100; width: 218px; height: 218px; position: absolute; top: '+$top+'px; left: '+$left+'px" id="tmp_'+$id+'" src="'+$img+'">');
						//$('img #tmp_'+$id).css('position','absolute');
						$('body img#tmp_'+$id).animate( { "position":"absolute","top": $offset_cart.top+"px" },
						{queue:false, duration:450 } )
						 .animate( { "left": $offset_cart.left+"px" }, {queue:false, duration:450 } )
						 .animate( { "width":"20px" }, {queue:false, duration:450 } )
						 .animate( { "height":"20px" }, {queue:false, duration:450 } )
						 .animate( { "opacity":"0" }, {queue:false, duration:450 } );
						setTimeout(function(){
							$('body img#tmp_'+$id).remove(); 
						}, 1000);
						
						$shopping_cart_items = parseInt($('.shopping_cart_informer a span').html());						
						$shopping_cart_items = $shopping_cart_items+1;
						$('.shopping_cart_informer a span').html($shopping_cart_items);
						$('.shopping_cart_counter_container').html($shopping_cart_items);
						
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
						} else alert('Уже в корзине');
				})
		$('.comparsion').click(function(){
			$id = $(this).attr('id').substr(2);
			//alert($id);
			$.ajax({
						dataType: 'text',
						type:'POST',
						data:'id='+$id,
						url: '<?= base_url().$this->uri->segment(1);?>/commerce/add_to_comparsion',
						success: function($ret){
							alert($ret);
						},
						error: function($exception){
						}
			})
		})
		})
</script>
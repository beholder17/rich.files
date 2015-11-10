<?php $this->lang->load('commerce', $this->uri->segment(1)); ?>
<h1 class='lined'><span><?=$category_info[0]['name']?></span></h1>
<?php
/* вывод слайдеров в т.ч. в дочерних категориях */
	$current_address = explode('/ru/',current_url());
	if (count($current_address)==1) $current_address = explode('/en/',$current_address[0]);
	$tmp =  modules::run('slider/index',$current_address[1]);
	if ($tmp == NULL) {
		if (isset($his_parent)){
			$get_slider_by_parent_link = explode('/',current_url());
			array_pop($get_slider_by_parent_link);
			array_push($get_slider_by_parent_link, $his_parent_alias);
			$get_slider_by_parent_link = implode('/',$get_slider_by_parent_link);
			$get_slider_by_parent_link = str_replace ('index.php/','',$get_slider_by_parent_link);
			echo modules::run('slider/index',$get_slider_by_parent_link);
		}
	} else { echo $tmp;}
?>


<?php 
//echo "<pre>";
//unset($content[0]['description']);
//print_r($subcategory_info[0]['alias']);  
?>

<?php 
if ($this->uri->segment(1)=='ru'){
	$cat = $subcategory_info[0]['name'];
	$subcat = $category_info[0]['name'];
	$fulltext = $subcategory_info[0]['fulltext'];
}
if ($this->uri->segment(1)=='en'){
	$cat = $subcategory_info[0]['name_tr'];
	$subcat = $category_info[0]['name'];
	$fulltext = $subcategory_info[0]['fulltext_tr'];
}
?>
<?php 
if ($this->uri->segment(1)=='en') {$by = 'by';}
if ($this->uri->segment(1)=='ru') {$by = 'от';}
if ($this->uri->segment(1)=='tr') {$by = 'by';}
if (!isset($pager)) $pager = '';
?>

<h2 class='lined'><span><?=$cat?></span></h2>
<ul>
<?php 
foreach ($his_children as $child)
{
	if ($this->uri->segment(1)=='ru') $name = $child['name'];
	if ($this->uri->segment(1)=='en') $name = $child['name_tr'];
	$link = base_url().$this->uri->segment(1).'/catalog/'.$category_info[0]['alias'].'/'.$child['alias'];
	echo "<li><a href='$link'>".$name."</a></li>";
}
?>
</ul>
<div style='position: relative; top: -10px;'><?= $pager;?></div>
<div class='catalog_canvas'>
<?php
//var_dump($content);
if (isset($content))
foreach ($content as $key=>$value){

	// get thumbnail file name
	/*$path_info = pathinfo($value['image']);
	$value['image'] = $path_info['filename'].'_thumb.'.$path_info['extension'];*/
	//$data['category_alias'] = $category_info[0]['alias'];
	
	//$data['value']['category_alias'] = "20";
	//$data['value']['subcategory_alias'] = $subcategory_info[0]['alias'];
	//$data['value'] = $value;
	$value['category_alias']=$category_info[0]['alias'];
	$value['subcategory_alias']=$subcategory_info[0]['alias'];
	$data['value'] = $value;
	$this->load->view('single_item_v',$data);
?>



	
<?php	

}

echo '<div class="bottom_pager">'.$pager.'</div>';

//$session_id = $this->session->userdata('session_id');
//echo $session_id;
//print_r ($this->session->userdata('comparsion'));
?>
</div>
<div class='bottom_description'>

<h2><?=$cat?> <?=$by;?> <?=$subcat?></h2>
<p><?=$fulltext?></p>
</div>
<style>
.bottom_description{
	display: inline-block;
	margin-top: 50px;
}

.catalog_canvas{
	display: table;
  width: 100%;
}
</style>

<script>
	    $(document).ready(function(){
                $('.product_item_buy').click(function(){
					if (!$(this).hasClass('at_cart')) {
					$id = $(this).children().attr('value');
					
					$img_name = $(this).parent().children().children().children();
					$img = $img_name[0]['currentSrc'];
					
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
						$('body').append('<img style="z-index: 100; width: 190px; height: 190px; position: absolute; top: '+$top+'px; left: '+$left+'px" id="tmp_'+$id+'" src="'+$img+'">');
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



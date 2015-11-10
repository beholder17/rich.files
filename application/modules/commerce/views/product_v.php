<!-- Add fancyBox -->
<link rel="stylesheet" href="<?= base_url();?>template/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?= base_url();?>template/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<?php $this->lang->load('commerce', $this->uri->segment(1)); ?>
<?php 
if ($this->uri->segment(1)=='ru') {$description = $item[0]['description'];}
if ($this->uri->segment(1)=='en') {$description = $item[0]['description_tr'];}
?>
<?php
// get thumbnail file name
$path_info = pathinfo($item[0]['image']);
$thumbnail_image = $path_info['filename'] . '_thumb.' . $path_info['extension'];

?>

<h1 style="margin: 15px 10px 15px 10px"><?php
    if ($this->uri->segment(1) == 'en') echo $item[0]['name_tr'];
    if ($this->uri->segment(1) == 'ru') echo $item[0]['name'];
    ?></h1>


<div class='item_image'>

    <a class="fancybox-button" rel="fancybox-button"
       href='<?= base_url(); ?>assets/img/products/<?= $item[0]['image']; ?>' title="<?= $item[0]['name']; ?>">
        <img src='<?= base_url(); ?>assets/img/products/thumbs/<?= $thumbnail_image; ?>'>
    </a>


</div>
<div class='item_description'>

	<?php if ($this->session->userdata('level')=='99') { ?>
    <div class="edit_item_link"><a href="<?= base_url(); ?>admin/edit_product/<?= $item[0]['id'] ?>">Edit</a>
    </div>
	<?php }?>

    <div class="product_description_line"><span><?=$this->lang->line('item_category')?>: </span><?= $item[0]['category'] ?></div>
    <div class="product_description_line"><span><?=$this->lang->line('item_subcategory')?>: </span> <a
            href="<?= base_url() . 'catalog/' . $item[0]['category_alias'] . '/' . $item[0]['subcategory_alias'] ?>"><?php 
			if ($this->uri->segment(1)=='en') echo $item[0]['subcategory_tr']; 
			if ($this->uri->segment(1)=='ru') echo $item[0]['subcategory']; 
			?></a>
    </div>
	
    <div class="product_description_line"><span><?=$this->lang->line('item_art')?>: </span> <?= $item[0]['sku'] ?></div>


    <div class='product_description_line'><span><?=$this->lang->line('item_status')?>: </span><?php
        if ($item[0]['status'] == 1) echo $this->lang->line('item_available');
        if ($item[0]['status'] != 1) echo $this->lang->line('item_not_available');
        ?></div>

	<div class="product_description_line" style='font-size: 33px !important;'><span><?=$this->lang->line('item_price')?>: </span> <?php 
	if ($this->uri->segment(1)=='en') echo '$ '.$item[0]['price-usd'];
	if ($this->uri->segment(1)=='ru') echo $item[0]['price-rub'].' &#8399;';
	if ($this->uri->segment(1)=='tr') echo $item[0]['price-try'].' £';
	?></div>	
	<?php //var_dump($cart);?>
    <div class='product_item_buy_individual <?php 
	$at_cart = array_keys($cart);
	$count = count($cart);
	$output_txt = "";
	for ($i = 0; $i < $count; $i++)
	{
		if ($cart[$at_cart[$i]]['id'] == $item[0]['id']) {$output_txt = "at_cart"; 
		$tmp = true;
		continue;
		}
	}
	echo $output_txt;
	?>' id='<?=$item[0]['id'];?>'><?= $this->lang->line('catalog_add_to_cart'); ?></div>
	<a class='comparsion_add' id='c_<?= $item[0]['id'] ?>' href=''><i class="fa fa-plus-square-o"></i>  <?=$this->lang->line('add_to_comparsion');?></a>
	<div class='comparsion_link'><i class="fa fa-refresh"></i> <a href='<?=base_url().$this->uri->segment(1)?>/commerce/comparsion'><?=$this->lang->line('do_comparsion');?></a></div>
    <br>
	<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki"></div>
</div>

<div class='item_tabs'>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1"><?=$this->lang->line('cart_descr')?></a></li>
            <li><a href="#tabs-2"><?=$this->lang->line('characteristics')?></a></li>
            <!--<li><a href="#tabs-3">Отзывы</a></li>-->
        </ul>
        <div id="tabs-1">
            <p><?=$description?></p>
        </div>
        <div id="tabs-2">
		
		







            <?php
            if ($item[0]['volume'] != NULL) echo "<p>".$this->lang->line('volume').": " . $item[0]['volume'] . "</p>";
            if ($item[0]['width'] != NULL) echo "<p>".$this->lang->line('width').": " . $item[0]['width'] . "</p>";
            if ($item[0]['height'] != NULL) echo "<p>".$this->lang->line('height').": " . $item[0]['height'] . "</p>";
            if ($item[0]['thickness'] != NULL) echo "<p>".$this->lang->line('thickness').": " . $item[0]['thickness'] . "</p>";
            if ($item[0]['weight'] != NULL) echo "<p>".$this->lang->line('weight').": " . $item[0]['weight'] . "</p>";
            if ($item[0]['material'] != NULL) echo "<p>".$this->lang->line('material').": " . $item[0]['material'] . "</p>";
            if ($item[0]['abrasiveness'] != NULL) echo "<p>".$this->lang->line('abrasiveness').": " . $item[0]['abrasiveness'] . "</p>";
            ?>
        </div>
        <!--
		<div id="tabs-3">
            <p>VK Widget Code</p>
        </div>
		-->
    </div>
	<div class='vk_comments'>
	<!-- Put this script tag to the <head> of your page -->
               <script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>
               <script type="text/javascript">
                 VK.init({apiId: 4473923, onlyWidgets: true});
               </script>
               
               <!-- Put this div tag to the place, where the Comments block will be -->
               <div id="vk_comments"></div>
               <script type="text/javascript">
               VK.Widgets.Comments("vk_comments", {limit: 10,width: "auto", attach: false});
               </script>
	</div>
</div>
<script>
    $(function () {
        $("#tabs").tabs();
    });
</script>

<div style='clear: both'></div>
<pre>
<?php //print_r($cart); ?>
    <?php //var_dump($item[0]); ?>

    <script>
        $(document).ready(function () {
            $('.product_item_buy_individual').click(function () {
                if (!$(this).hasClass('at_cart')) {
                    //$id = $(this).children().attr('value');
					$id = $(this).attr('id');
                    //alert($id);
                    $.ajax({
                        dataType: 'text',
                        type: 'POST',
                        data: 'json_data=' + $id,
                        url: '<?= base_url().$this->uri->segment(1);?>/commerce/add_to_cart',
                        success: function ($ret) {
                            //reload();
                            //alert('в корзине');
                            $('.product_item_buy_individual').html('В корзине');
                            $offset = $('.item_image img').offset();
                            $offset_cart = $('.shopping_cart_informer').offset();
                            $left = $offset.left;//+0.5;
                            $top = $offset.top;//+0.5;
                            //alert($left+' - '+$top);
                            //$('#'+$id+' .product_item_image').eq(0).clone();
                            $('body').append('<img style="z-index: 100; width: 218px; height: 218px; position: absolute; top: ' + $top + 'px; left: ' + $left + 'px" id="tmp_' + $id + '" src="<?= base_url(); ?>assets/img/products/thumbs/<?= $thumbnail_image;?>">');
                            //$('img #tmp_'+$id).css('position','absolute');
                            $('body img#tmp_' + $id).animate({"position": "absolute", "top": $offset_cart.top + "px"},
                                {queue: false, duration: 450})
                                .animate({"left": $offset_cart.left + "px"}, {queue: false, duration: 450})
                                .animate({"width": "20px"}, {queue: false, duration: 450})
                                .animate({"height": "20px"}, {queue: false, duration: 450})
                                .animate({"opacity": "0"}, {queue: false, duration: 450});
                            setTimeout(function () {
                                $('body img#tmp_' + $id).remove();
                            }, 1000);

                            $shopping_cart_items = parseInt($('.shopping_cart_informer a span').html());
                            $shopping_cart_items = $shopping_cart_items + 1;
                            $('.shopping_cart_informer a span').html($shopping_cart_items);
                            $('.shopping_cart_counter_container').html($shopping_cart_items);

                            $('.product_item_buy_individual').addClass('at_cart');
                            //$('#'+$id+' .product_item_image').appendTo('#logo_block');
                        },
                        error: function ($exception) {
                            alert('error!');
                            alert('Exeption:' + $exception);
                        },
                        done: function () {
                            alert('done!');
                            alert('Exeption:' + $exception);
                        }
                    });
                } else alert('Уже в корзине');
            })


            $(".fancybox-button").fancybox({
                prevEffect: 'none',
                nextEffect: 'none',
                closeBtn: true,
                helpers: {
                    title: {type: 'inside'},
                    buttons: {}
                }
            });
			
			$('.comparsion_add').click(function(){
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

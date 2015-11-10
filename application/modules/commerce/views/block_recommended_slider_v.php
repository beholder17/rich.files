
<div class='recommended_block'>
	<div class='recommended_block_header'><?= $this->lang->line('featured_products');?></div>
	<div class="jcarousel">
		<ul>
		<?php
		//var_dump($items);
		//print_r ($items);
		foreach($items as $value)
		{
			$link = base_url().$this->uri->segment(1)."/catalog/".$value['category_alias']."/".$value['subcategory_alias']."/".$value['id'];
			$path_info = pathinfo($value['image']);
			$value['image'] = $path_info['filename'].'_thumb.'.$path_info['extension'];
		?>

			<li class='side_scroll_li'>
			<div class='side_scroll_item'>
			<div style='text-align: center'>
				<a href='<?=$link?>'><img class='side_scroll_img' src='<?=base_url().'assets/img/products/thumbs/'.$value['image']?>'>
				</div>
				
				<div class='side_scroll_price'><?php 
				if ($this->uri->segment(1)=='en') echo '$ '.$value['price-usd'];
				if ($this->uri->segment(1)=='ru') echo $value['price-rub'].' &#8399;';
				if ($this->uri->segment(1)=='tr') echo $value['price-try'].' £';
				?></div>
				<div class='side_scroll_name'><?= $value['name'];?></div>
				<div style='text-align: center; margin: 3px 0px;'>
				<a href='<?=$link?>' class='side_scroll_more'>Просмотр</a>
				</div>
				
			</div>
			</li>
		<?php	
		}
		?>
		</ul>
	</div>
</div>
<!--<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
<a href="#" class="jcarousel-control-next">&rsaquo;</a>
<p class="jcarousel-pagination"></p>-->
<style>
.side_scroll_more
{
	background: #f6627c; /* Old browsers */
	background: -moz-linear-gradient(top,  #f6627c 0%, #f6627c 50%, #e23956 51%, #e23956 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f6627c), color-stop(50%,#f6627c), color-stop(51%,#e23956), color-stop(100%,#e23956)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  #f6627c 0%,#f6627c 50%,#e23956 51%,#e23956 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  #f6627c 0%,#f6627c 50%,#e23956 51%,#e23956 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  #f6627c 0%,#f6627c 50%,#e23956 51%,#e23956 100%); /* IE10+ */
	background: linear-gradient(to bottom,  #f6627c 0%,#f6627c 50%,#e23956 51%,#e23956 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6627c', endColorstr='#e23956',GradientType=0 ); /* IE6-9 */

	width: 80px;
    height: 27px;
    color: white;
    font-size: 13px;
    border-radius: 5px;
   
    
    border: none;
    text-shadow: 1px 1px 0px #E23956;
    box-shadow: 0px 2px 4px rgba(0,0,0,0.2);
    padding: 4px;
}

.side_scroll_item{
	background-color: white;
	height: 212px;
}

.side_scroll_item a{text-decoration: none;}
.side_scroll_item a:hover{text-decoration: underline;}

.side_scroll_li{
    width: 204px;
}
.side_scroll_price{
/*display: inline-block; */
    text-align: center;
    /* float: right; */
    /* position: absolute; */
    font-size: 20px;
    /* text-align: right; */
    /* width: 85px; */
    /* overflow: hidden; */
}
.side_scroll_img{
	width: 120px;
//	clear: both
margin: 5px;
   
    padding: 4px;
}

.side_scroll_name{
	font-size: 13px;
    text-align: center;
}
.recommended_block{
    width: 205px;
	}

</style>
<script>
(function($) {
    $(function() {
        $('.jcarousel').jcarousel({
    animation: {
        duration: 2000,
        easing:   'easeOutQuart',
        complete: function() {
        }
		},
		auto: 3,
		wrap: 'circular',}).jcarouselAutoscroll({
        interval: 3000,
        target: '+=1',
        autostart: true
    });

        $('.jcarousel-control-prev')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });

        $('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .jcarouselPagination();
    });
})(jQuery);
</script>
<style>
	/*
This is the visible area of you carousel.
Set a width here to define how much items are visible.
The width can be either fixed in px or flexible in %.
Position must be relative!
*/
.jcarousel {
    position: relative;
    overflow: hidden;
}

/*
This is the container of the carousel items.
You must ensure that the position is relative or absolute and
that the width is big enough to contain all items.
*/
.jcarousel ul {
    width: 20000em;
    position: relative;

    /* Optional, required in this case since it's a <ul> element */
    list-style: none;
    margin: 0;
    padding: 0;
}

/*
These are the item elements. jCarousel works best, if the items
have a fixed width and height (but it's not required).
*/
.jcarousel li {
    /* Required only for block elements like <li>'s */
    float: left;
}
</style>
 <!--
      'id' => string '183' (length=3)
      'name' => string 'Гель-лак с мерцанием RVB-10-001' (length=48)
      'name_tr' => string 'Shimmer RVB-10-001 ile Jel lehce' (length=33)
      'category' => string 'Rich World' (length=10)
      'category_alias' => string 'rich-world' (length=10)
      'subcategory' => string 'УФ лампы' (length=15)
      'subcategory_alias' => string 'uf-lampy' (length=8)      
      'price-usd' => string '3' (length=1)
      'price-usd-promo' => string '3' (length=1)
      'price-try' => string '3' (length=1)
      'price-try-promo' => string '3' (length=1)
      'price-rub' => string '3' (length=1)
      'price-rub-promo' => string '3' (length=1)
      'image' => string 'RVB-10-001.png' (length=14)
      'sku' => string 'RVB-10-001' (length=10)
      'status' => string '0' (length=1)
      'novelty' => string 'on' (length=2)
      'recommended' => string 'on' (length=2)
      'promo' => string 'on' (length=2)
      'type' => string 'Приборы' (length=14)
      'volume' => string '10' (length=2)
      'width' => string '' (length=0)
      'height' => string '' (length=0)
      'thickness' => string '' (length=0)
      'weight' => string '' (length=0)
      'material' => string '' (length=0)
      'abrasiveness' => string '' (length=0)
      'seo_title' => string 'aaa' (length=3)
      'seo_description' => string 'bbb' (length=3)
      'seo_keywords' => string 'ccc' (length=3)
  1 
  -->
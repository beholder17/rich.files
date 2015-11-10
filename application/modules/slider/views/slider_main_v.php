<?php //print_r($slider_images); ?>

<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/slider/engine1/style.css" />
<div id="wowslider-container1">
<div class="ws_images">
	<ul>
		<?php foreach ($slider_images as $key=>$value) { ?>
		<!--<li><a href="<?= $value['link']?>"><img src="<?= base_url()?>assets/slider/data1/images/<?= $value['img']?>" alt="<?= $value['img_alt']?>" title="<?= $value['img_title']?>" id="wows1_3"/></a></li>-->
		<li><a href="<?= $value['link']?>"><img src="<?= base_url()?><?= $value['img']?>" alt="<?= $value['img_alt']?>" title="<?= $value['img_title']?>" id="wows1_3"/></a></li>
		<?php } ?>
	</ul>
</div>
<div class="ws_bullets">
	<div>

		<?php foreach ($slider_images as $key=>$value) { ?>
		<!--<a href="<?= $value['link']?>" title="<?= $value['img_title']?>"><span><img src="<?= base_url()?>assets/slider/data1/tooltips/<?= $value['img']?>" alt="<?= $value['img_alt']?>"/>5</span></a>-->
		<a href="<?= $value['link']?>" title="<?= $value['img_title']?>"><span><img style='width: 30px; height: 30px;' src="<?= base_url()?><?= $value['img']?>" alt="<?= $value['img_alt']?>"/>5</span></a>
		<?php } ?>
	</div>
</div>
<div class="ws_shadow"></div>
</div>	

<?php if ($this->session->userdata('level')=='99') { ?>
<a id='edit_slider' href='<?= base_url();?>admin/edit_slider/<?= $slider_body[0]['id']; ?>'>Edit Slider</a>
	<?php }?>
<script type="text/javascript" src="<?= base_url()?>assets/slider/engine1/wowslider.js"></script>
<script type="text/javascript" src="<?= base_url()?>assets/slider/engine1/script.js"></script>

<?php
//echo "<pre>";
//print_r($slider_images);
?>
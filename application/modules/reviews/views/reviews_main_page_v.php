<?php
if ($this->uri->segment(1)=='en') {
	$lang['reviews'] = 'Reviews';
	$lang['add_review'] = 'Add own review';
	$lang['author'] = 'Author';
}

if ($this->uri->segment(1)=='ru') {
	$lang['reviews'] = 'Отзывы';
	$lang['add_review'] = 'Добавить свой отзыв';
	$lang['author'] = 'Автор';
}

function crop_str($string, $limit)
{
$substring_limited = substr($string,0, $limit);        //режем строку от 0 до limit
return substr($substring_limited, 0, strrpos($substring_limited, ' ' ));    //берем часть обрезанной строки от 0 до последнего пробела
}


?>

<h1 class='lined'><span><?=$lang['reviews']?></span></h1>
<?= $pager ?>
<div class="add_review"><a class="btn_v2" style='margin: 10px;' href="<?=base_url().$this->uri->segment(1)?>/reviews/add_review"><i class="fa fa-pencil"></i> <?=$lang['add_review']?></a></div>
<div style='margin-top:20px;'>
		<?php foreach($approved_reviews as $key => $value){ ?>
		<div class="review_line">
			<div class="review_id"><span><?=$lang['author']?>: </span><?=$value['name'];?>,</div>
			
			<div class="review_city"><?=$value['city'];?></div>
			<img  class='review_pic' src='<?php if ($value['image']!=NULL) echo base_url().'assets/reviews_img/'.$value['image'];
			else echo base_url().'template/img/no_picture.jpg';
			?>'>
			<div class="review_text"><?=crop_str($value['fulltext'],600).'...';?></div>
			<!--<div class="review_date"><?=$value['date'];?></div>-->
			<div class="review_link">
				<!--<a href="<?= base_url().$this->uri->segment(1)?>/reviews/<?=$value['id']?>">Подробнее...</a>-->
			</div>
		</div>



	<?php } ?>
</div>

<?php //var_dump($approved_reviews); ?>

	
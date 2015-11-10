<h1 class='lined'><span><?php 
if ($this->uri->segment(1)=='ru') {
	echo $category_info[0]['name'];
	$lang_to_read = 'Читать';
	$current_lang = 'ru';
}
if ($this->uri->segment(1)=='en') {
	echo $category_info[0]['name_tr'];
	$lang_to_read = 'More';
	$current_lang = 'en';
}
?></span></h1>
<div class='content_list'>
<?php //print_r ($category_info[0]['name']); 
function crop_str($string, $limit)  
{
$substring_limited = substr($string,0, $limit);        //режем строку от 0 до limit
return substr($substring_limited, 0, strrpos($substring_limited, ' ' ));    //берем часть обрезанной строки от 0 до последнего пробела
}

$num=1;
//var_dump($content);
foreach ($content as $key=>$value)
{
	if ($current_lang=='en') {
		$fulltext = $value['fulltext_tr'];
		$title = $value['title_tr'];
	}
	if ($current_lang=='ru') {
		$fulltext = $value['fulltext'];
		$title = $value['title'];
	}
?>
  <!--  echo "<h3>".$value['title']."</h3>";
    
	/*foreach ($value as $item=>$detail)
	{
		echo $item." - ".$detail."<br>";
	}
	*/-->



	
	<div class='content_line'>
		<div class='content_line_title'><a href='<?= base_url().$this->uri->segment(1).'/'.$category.'/'.$value['alias'] ?>'><h3 style='margin-bottom: 5px;'><?php //echo $num; $num++;?><?= $title ?></h3></a></div>
		
		<div class='content_line_img'><a href='<?= base_url().$this->uri->segment(1).'/'.$category.'/'.$value['alias'] ?>'>
		<?php if ($value['image']!=NULL OR $value['image']!='') {?><img src='<?= base_url().$value['image']?>'> <?php } else echo "<img src='".base_url()."template/img/no_picture.jpg'>"?>
		</a>
		</div>
		<div class='content_line_date'><?= $value['date'] ?></div>
		<div class='content_line_anounce'><?php echo strip_tags(crop_str($fulltext,400)).'...'; ?></div>
		<div class='content_line_readmore'><a href='<?= base_url().$this->uri->segment(1).'/'.$category.'/'.$value['alias'] ?>'><?=$lang_to_read?>...</a></div>
	</div>


	
	<?php
}

?>
</div>
<?= $pager ?>
<style>
.content_line_img{
	max-width: 120px;
	max-height: 120px;
	
	float: left;
	margin: 0px 8px 8px 0px;
	overflow: hidden;


	
}
.content_line_readmore{
	position: absolute;
	bottom: 10px;
	right: 5px;
}

.pagination {
  clear: both;
  text-align: center;
  /* color: red; */
  font-size: 18px;
}

.content_line{
  clear: both;
  height: 165px;
  position: relative;
}

.content_list{
	  border-bottom: 1px dashed #E299A8;
}
</style>

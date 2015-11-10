<div class='news_block'>

<h2 class='lined'><span><?php
if ($this->uri->segment(1)=='tr') echo "Son Haberler";
if ($this->uri->segment(1)=='en') echo "Latest news";
if ($this->uri->segment(1)=='ru') echo "Последние новости";
?></span></h2>


<?php //print_r ($content); 
function crop_str($string, $limit)  
{
$substring_limited = substr($string,0, $limit);        //режем строку от 0 до limit
return substr($substring_limited, 0, strrpos($substring_limited, ' ' ));    //берем часть обрезанной строки от 0 до последнего пробела
}

if ($this->uri->segment(1)=='en') $lang['more'] = 'More...';
if ($this->uri->segment(1)=='ru') $lang['more'] = 'Узнать детали...';

foreach ($news as $key=>$value)
{	$custom_time = explode (" ",$value['date']);
	$custom_day = explode ("-",$custom_time[0]);
	$custom_timer = explode (":",$custom_time[1]);
	$date = $custom_day[2].'.'.$custom_day[1].'.'.$custom_day[0].' '.$custom_timer[0].':'.$custom_timer[1];
?>
	<div class='content_list'>
	<div class='content_line'>
		<div class='content_line_title'><a href='<?= base_url().$this->uri->segment(1).'/'.$category_content.'/'.$value['alias'] ?>'><h3><?php
		if ($this->uri->segment(1)=='ru') echo $value['title'];
		if ($this->uri->segment(1)=='en') echo $value['title_tr'];
		?></h3></a></div>
		
		<div class='content_line_img animated'><a href='<?= base_url().$this->uri->segment(1).'/'.$category_content.'/'.$value['alias'] ?>'><img src='<?php if ($value['image']!=NULL) echo base_url().$value['image']; else echo base_url().'template/img/no_picture.jpg'; ?>'></a></div>
		<div class='content_line_date'><?= $date ?></div>
		<div class='content_line_anounce'><?php 
		/*if ($this->uri->segment(1)=='en') echo strip_tags(crop_str($value['fulltext'],700))."..."; */
		if ($this->uri->segment(1)=='ru') echo strip_tags(crop_str($value['fulltext'],700))."..."; 
		if ($this->uri->segment(1)=='en') echo strip_tags(crop_str($value['fulltext_tr'],700))."..."; 
		?></div>
		<div class='content_line_readmore'><a href='<?= base_url().$this->uri->segment(1).'/'.$category_content.'/'.$value['alias'] ?>'><?=$lang['more']?></a></div>
	</div>
</div>

	
	<?php
	
}

?>
</div>
<style>
.breadcrumbs{
	
	display: initial;
}
</style>
<script>
       $('.content_line_img').viewportChecker({
			classToAdd: 'fadeInUp', // Class to add to the elements when they are visible
			classToRemove: 'fadeInUp', // Class to remove before adding 'classToAdd' to the elements
			repeat: true // Add the possibility to remove the class if the elements are not visible
		});
</script>

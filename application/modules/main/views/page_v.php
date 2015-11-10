<?php if ($this->session->userdata('level')=='99') { ?>
    <a href='<?= base_url();?>admin/edit_page/<?= $content[0]['id'];?>'>редактировать</a>
<a class='del_link' href='javascript:del()' id=<?= $content[0]['id'];?>>удалить</a>
	<?php }?>

<?php foreach($content as $value){?>
<h1 class='lined'><span><?php 
if ($this->uri->segment(1)=='ru') echo $value['title'];
if ($this->uri->segment(1)=='en') echo $value['title_tr'];
?></span></h1>
<?php 
if ($this->uri->segment(1)=='ru') echo $value['fulltext']; 
if ($this->uri->segment(1)=='en') echo $value['fulltext_tr']; 
?>	
	
<?}?>
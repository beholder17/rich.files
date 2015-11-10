<?php //print_r ($content); 
function crop_str($string, $limit)  
{
$substring_limited = substr($string,0, $limit);        //режем строку от 0 до limit
return substr($substring_limited, 0, strrpos($substring_limited, ' ' ));    //берем часть обрезанной строки от 0 до последнего пробела
}
?>
<pre>
<?php 
/*$session_id[0] = $this->session->userdata('adress');
$session_id[1] = $this->session->userdata('email');
$session_id[2] = $this->session->userdata('level');
$session_id[3] = $this->session->userdata('test');
$session_id[4] = $this->session->userdata('otch');
$session_id[5] = $this->session->userdata('logged_in');
*/


//print_r($session_id);
?>
</pre>


<?php if ($this->session->userdata('level')=='99') { ?>
    <a class='edit_link' href='<?= base_url();?>admin/edit_content/<?= $content[0]['id'];?>'>редактировать</a> - 
<a class='del_link' href='javascript:del()' id=<?= $content[0]['id'];?>>удалить</a>
	<?php }?>

<?php
foreach ($content as $key=>$value)
{ //echo $value['fulltext'];
$custom_time = explode (" ",$value['date']);
	$custom_day = explode ("-",$custom_time[0]);
	$custom_timer = explode (":",$custom_time[1]);
	$date = $custom_day[2].'.'.$custom_day[1].'.'.$custom_day[0].' '.$custom_timer[0].':'.$custom_timer[1];
?>
<h1><?php 
if ($this->uri->segment(1)=='en') echo $value['title_tr']; 
//if ($this->uri->segment(1)=='tr') echo $value['title_tr']; 
if ($this->uri->segment(1)=='ru') echo $value['title']; 
?></h1>
<div class='content_line_date'><?=$date?></div>
<p><?php 
if ($this->uri->segment(1)=='en') echo $value['fulltext_tr']; 
//if ($this->uri->segment(1)=='tr') echo $value['fulltext_tr']; 
if ($this->uri->segment(1)=='ru') echo $value['fulltext']; 
?></p>

<?php
}

?>
<script>
function del(){
if (confirm("Действительно удалить материал? (восстановление не возможно)")) {
	$id = $('a.del_link').attr('id');
  $.ajax({
				dataType: 'json',
				type:'POST',
				data:'&id='+<?= $content[0]['id']?>,
				url: '<?= base_url();?>'+'admin/del_content',
				success: function($ret){				
				window.history.back();
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
} 
}


</script>
<style>
.content_line_img{
	width: 70px;
	height: 70px;
	background-color: red;
	float: left;
	margin: 0px 8px 8px 0px;
	
}
</style>


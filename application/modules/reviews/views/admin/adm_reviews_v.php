<?php
function crop_str($string, $limit)
{
$substring_limited = substr($string,0, $limit);        //режем строку от 0 до limit
return substr($substring_limited, 0, strrpos($substring_limited, ' ' ));    //берем часть обрезанной строки от 0 до последнего пробела
}
?>
<div class='content_page'>
<h1>Отзывы</h1>
<a id='unpublish_show' href='javascript:void(0)'>Только неопубликованные</a>
<table class="table table-condensed table-hover table-striped table-bordered">
	<thead>
		<td>Изобр.</td>
		<td>Имя</td>
		<td>Откуда</td>
		<td>Текст</td>
		<td>Email</td>
		<td>Опубликован</td>
		<td></td>
	</thead>
<?php foreach ($reviews as $value){?>
	<tr id='tr_<?=$value['id'];?>'>
		<td><?php 
		if ($value['image']!=NULL) echo "<img width='100px' src='".base_url()."assets/reviews_img/".$value['image']."'>"; else echo "no_img";
		
		?>
		
		</td>
		<td class='td_name'><?=$value['name']?></td>
		<td class='td_from'><?=$value['city']?></td>
		<td class='td_text'><?=crop_str($value['fulltext'],200).'...'?><div style='display: none'><?=$value['fulltext']?></div></td>
		<td class='td_email'><?=$value['email']?></td>		
		<td class='td_publish'><?php
		if ($value['show']=='1' OR $value['show']=='on') echo "Yes"; else echo "No";
		
		?></td>		
		<td>
		<!--<a href='<?=$value['id']?>'>Edit</a>
		<a href='<?=$value['id']?>'>publish</a>
		<a href='<?=$value['id']?>'>unpublish</a>
		<a href='<?=$value['id']?>'>delete</a>-->
		<a class='edit_review' id='<?=$value['id']?>' href='javascript:void(0)'>Edit</a>
		</td>
	</tr>
<?php }?>
</table>
<? //print_r($reviews); ?>


<div id="dialog_edit" title="Редактировать категорию" style='display: none'>
	<form method='post' id='form_edit_review'>
	Name
	<p><input id='name' name='name' type='text' size='50' style='width: 300px'></p>
	From
	<p><input id='city' name='city' type='text' size='50' style='width: 300px'></p>
	E-mail
	<p><input id='email' name='email' type='text' size='50' style='width: 300px'></p>
	Review
	<p><textarea id='text' rows="10" cols="50" name='fulltext' style='width: 300px'></textarea></p>
	<p id='' class='appended_checkbox'><input id='show_checkbox' type='checkbox' name='show'> Publish</p>
	<input id='id' name='id' type='hidden'>	
	</form>
</div>

<div id="dialog-confirm" title="Подтверждение действия" style='display: none'>
	<p>Добавить товар?<p>
</div>


</div>


<script>
function waiting(){
		 $('div.content_my').html('<div class="waiting" style="opacity: 0.1; position: relative;">Waiting</div>');
		 $('div.waiting').animate({opacity: 1}, 900);
}

function show() { $('div.content_page').addClass('animated zoomIn'); }

function reload(){	
	waiting();
    $('div.content_my').load('reviews/adm_reviews/publish',function(){show()}); 
}

function waiting()
	{
		 $('div.content_my').html('<div class="waiting" style="opacity: 0.1; position: relative;">Ожидание</div>');
		 $('div.waiting').animate({opacity: 1}, 900);
	}
	
$('a#unpublish_show').click(function(){
	waiting(); 
	$('div.content_my').load('reviews/adm_reviews/unpublish',function(){show()}); 
});
				

$('#show_checkbox').click(function(){
	
	$tmp = $(this).attr('checked');
	if ($tmp === 'checked') {$('#show_checkbox').attr('checked','');} else {$('#show_checkbox').removeAttr('checked');}
});
				
$('.edit_review').click(function(){
	$id = $(this).attr('id');
	$name = $('#tr_'+$id+' .td_name').html();
	$from = $('#tr_'+$id+' .td_from').html();
	$email = $('#tr_'+$id+' .td_email').html();
	$fulltext = $('#tr_'+$id+' .td_text div').html();
	$publish = $('#show_checkbox').attr('checked');
	$('#dialog_edit #id').val($id);
	$('#dialog_edit #name').val($name);
	$('#dialog_edit #city').val($from);
	$('#dialog_edit #email').val($email);	
	$('#dialog_edit #text').html($fulltext);
	$(function() {    
	$( "#dialog_edit" ).dialog({
      resizable: true,
      height:600,
	  width:375,
      modal: true,
      buttons: {
		"Delete": function() {
			//alert($id);
			$.ajax({
				dataType: 'json',
				type:'POST',
				data:'json_data='+$id,
				url: '<?= base_url();?>admin/reviews_delete',
				success: function($ret){
				$("#dialog_edit").dialog( "close" );
				reload();
				//alert('DONE!');
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
		   },
		"Apply": function() {
			$( this ).dialog( "close" );
				var $formdata_all = $('form#form_edit_review').serializeJSON();
				$data = encodeURIComponent(JSON.stringify($formdata_all));
				console.log($formdata_all);
				$.ajax({
				dataType: 'json',
				type:'POST',
				data:'json_data='+$data,
				url: '<?= base_url();?>admin/apply_reviews',
				success: function($ret){
				reload();
				//alert('DONE!');
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
        },
        "Cancel": function() {
          $( this ).dialog( "close" );
        }
	  }

});
});
	
	
});
</script>


 

 

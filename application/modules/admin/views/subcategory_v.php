<div class='content_page'>
<h2>Подкатегории</h2>
<a class='btn' href='javascript: void(0)' id='add_subcategory_btn_open_dlg'>+ Добавить подкатегорию</a>
<table class="table table-condensed table-hover table-striped table-bordered">
<thead>
	<th style='width: 100px'>Название</th>
	<th style='width: 100px'>Название англ</th>
	<th style='width: 150px'>Описание</th>
	<th style='width: 150px'>Описание англ</th>
	<th style='width: 150px'>Текст</th>
	<th style='width: 150px'>Текст англ</th>	
	<th style='width: 100px'>Алиас</th>
	<th style='width: 100px'>Родитель</th>
	<th>Опции</th>
</thead>
<?php
foreach ($data as $value){?>
<tr style='height: 30px important; overflow: hidden' class='tr_<?= $value['id']?>'>
	<td class='td_name'><?= $value['name'] ?></td>
	<td class='td_name_tr'><?= $value['name_tr'] ?></td>
	<td class='td_description'><?= $value['description'] ?></td>
	<td class='td_description_tr'><?= $value['description_tr'] ?></td>
	<td class='td_fulltext'><?= $value['fulltext'] ?></td>
	<td class='td_fulltext_tr'><?= $value['fulltext_tr'] ?></td>	
	<td class='td_alias'><?= $value['alias'] ?></td>
	<td class='td_parent'><?= $value['parent'] ?></td>
	<td class='td_options'>
	<a href='javascript: void(0)' class='edit_cat' id='cat_edit_<?= $value['id']?>'>Edit</a>
	<a href='javascript: void(0)' class='del_cat' id='cat_del_<?= $value['id']?>'>Delete</a>
	</td>
</tr>	
<?php }?>
</table>
</div>

<div id="dialog-confirm" title="Добавить подкатегорию" style='display: none'>
	<form method='post'>
	Название
	<p><input id='subcategory_name' name='subcategory_name' type='text' size='50' style='width: 100%'></p>
	Название на английском
	<p><input id='subcategory_name_tr' name='subcategory_name_tr' type='text' size='50' style='width: 100%'></p>
	Описание
	<p><textarea id='subcategory_description' rows="6" cols="50" name='subcategory_description' style='width: 100%'></textarea></p>		
	Описание на английском
	<p><textarea id='subcategory_description_tr' rows="6" cols="50" name='subcategory_description_tr' style='width: 100%'></textarea></p>
	</form>
</div>

<div id="dialog-confirm-del" title="Подтвердите действие" style='display: none'>
	<p>Вы действительно хотите удалить эту подкатегорию?</p>
</div>

<div id="dialog-confirm-edit" title="Редактировать подкатегорию" style='display: none'>
	<form method='post'>
	Название
	<p><input id='subcategory_name' name='subcategory_name' type='text' size='50' style='width: 300px'></p>
	Название на английском
	<p><input id='subcategory_name_tr' name='subcategory_name_tr' type='text' size='50' style='width: 300px'></p>	
	Описание
	<p><textarea id='subcategory_description' rows="6" cols="50" name='subcategory_description'style='width: 100%'></textarea></p>		
	Описание на английском
	<p><textarea id='subcategory_description_tr' rows="6" cols="50" name='subcategory_description_tr'style='width: 100%'></textarea></p>
	Полный текст
	<p><textarea id='subcategory_fulltext' rows="6" cols="50" name='subcategory_fulltext' style='width: 100%'></textarea></p>
	Полный текст на английском
	<p><textarea id='subcategory_fulltext_tr' rows="6" cols="50" name='subcategory_fulltext_tr' style='width: 100%'></textarea></p>
	Алиас (для опытных пользователей)
	<p><input id='subcategory_alias' name='subcategory_alias' type='text' size='50' style='width: 300px'></p>
	Родительская подкатегория
	<p><!--<input id='subcategory_parent' name='subcategory_parent' type='text' size='50' style='width: 300px'>-->
	<select name="parent" id="parent">
		<option>Выберите родительскую подкатегорию</option>
		<?php foreach ($data as $value){ ?>
		<option value="<?=$value['id']?>"><?=$value['id'].' - '.$value['name']?></option>
		<?php } ?>
    </select>
    </p>
	</form>
</div>

<script>
function reload()
{
	$('.ui-dialog').html( "close" );				
	$('div.content_my').load('admin/subcategory',function(){show()}); 
}

$(function() {
$('td.td_options a.del_cat').click(function(){
	$get_id = $(this).attr('id');
	$get_id = $get_id.replace(/[^-0-9]/gim,'');
	/*alert($rrtd);*/
	$(function() {
	$( "#dialog-confirm-del" ).dialog({
      resizable: false,
      height:200,
	  width:370,
      modal: true,
      buttons: {
		"Удалить": function() {
			var form_data = {
				"id":$get_id
		        };
				$.ajax({
				dataType: 'json',
				type:'POST',
				data:'json_data=' + $.toJSON(form_data),
				url: '<?= base_url();?>admin/del_subcategory',
				success: function($ret){
				reload();
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
        "Отмена": function() {
          $( this ).dialog( "close" );
        }
	  }

});
});
});

$('td.td_options a.edit_cat').click(function(){
	$get_id = $(this).attr('id');
	$get_id = $get_id.replace(/[^-0-9]/gim,'');
	$name = $('.tr_'+$get_id+' .td_name').html();
	$name_tr = $('.tr_'+$get_id+' .td_name_tr').html();
	$description = $('.tr_'+$get_id+' .td_description').html();
	$description_tr = $('.tr_'+$get_id+' .td_description_tr').html();
	$alias = $('.tr_'+$get_id+' .td_alias').html();
	$fulltext = $('.tr_'+$get_id+' .td_fulltext').html();
	$fulltext_tr = $('.tr_'+$get_id+' .td_fulltext_tr').html();
	$parent = $('.tr_'+$get_id+' .td_parent').html();
	
	$('#dialog-confirm-edit #subcategory_name').attr('value',$name);
	$('#dialog-confirm-edit #subcategory_name_tr').attr('value',$name_tr);
	$('#dialog-confirm-edit #subcategory_description').html($description);
	$('#dialog-confirm-edit #subcategory_description_tr').html($description_tr);
	$('#dialog-confirm-edit #subcategory_alias').attr('value',$alias);
	$('#dialog-confirm-edit #subcategory_fulltext').attr('value',$fulltext);
	$('#dialog-confirm-edit #subcategory_fulltext_tr').attr('value',$fulltext_tr);
	$('#dialog-confirm-edit #parent').attr('value',$parent);

	
	$(function() {
	$( "#dialog-confirm-edit" ).dialog({
      resizable: true,
      height:800,
	  width:700,
      modal: true,
      buttons: {
		"Принять изменения": function() {
			  var form_data = {
				"id":$get_id,
				"name":$("#dialog-confirm-edit #subcategory_name").val(),
				"name_tr":$("#dialog-confirm-edit #subcategory_name_tr").val(),
				"alias":$("#dialog-confirm-edit #subcategory_alias").val(),
				"description":$("#dialog-confirm-edit #subcategory_description").val(),
				"description_tr":$("#dialog-confirm-edit #subcategory_description_tr").val(),
				"fulltext":$("#dialog-confirm-edit #subcategory_fulltext").val(),
				"fulltext_tr":$("#dialog-confirm-edit #subcategory_fulltext_tr").val(),
				"parent":$("#dialog-confirm-edit #parent").val()
		        };
				if (form_data.name !='' && form_data.alias != '') {
				$.ajax({
				dataType: 'json',
				type:'POST',
				data:'json_data=' + $.toJSON(form_data),
				url: '<?= base_url();?>admin/edit_subcategory',
				success: function($ret){
				reload();
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
				} else alert ('Поля должны быть заполнены');
		   },
        "Отмена": function() {
          $( this ).dialog( "close" );
        }
	  }

});
});
});

});

  $(function() {
    $('#add_subcategory_btn_open_dlg').click(function(){
	$( "#dialog-confirm" ).dialog({
      resizable: false,
      height:750,
	  width:370,
      modal: true,
      buttons: {
        "Добавить подкатегорию": function() {
				var form_data = {
				"name":$("#dialog-confirm #subcategory_name").val(),
				"name_tr":$("#dialog-confirm #subcategory_name_tr").val(),
				"description":$("#dialog-confirm #subcategory_description").val(),
				"description_tr":$("#dialog-confirm #subcategory_description_tr").val()
		        };
				if (form_data.name !='') {
				$.ajax({
				dataType: 'json',
				type:'POST',
				data:'json_data=' + $.toJSON(form_data),
				url: '<?= base_url();?>admin/add_subcategory',
				success: function($ret){
				//alert('Категория успешно добавлена');
				//$(this).dialog( "close" );
				reload();
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
		} else alert('Поля должны быть заполнены');
        },
        "Отмена": function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
  })
</script>
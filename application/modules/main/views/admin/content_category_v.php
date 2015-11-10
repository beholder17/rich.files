<div class='content_page'>
<h2>Категории контента</h2>
<p><small>Материал типа 'page' - является системным. Его нельзя удалить или переименовать. 
Этот материал отвечает за вывод статических страниц, таких как 'О компании', 'Оплата и доставка' и т.д.</small></p>
<a href='javascript: void(0)' id='add_content_category_btn_open_dlg'>+ Добавить категорию контента</a>
<table class="table table-condensed table-hover table-striped table-bordered">
<thead>
	<th>Название</th>
	<th>Алиас</th>
	<th>Опции</th>
</thead>
<?php
foreach ($content_category_list as $value){?>
<tr class='tr_<?= $value['id']?>'>
	<td class='td_name'><?= $value['name'] ?></td>
	<td class='td_alias'><?= $value['category'] ?></td>
	<td class='td_options'>
	<?php if ($value['name']!='Страница'):?>
	<a href='javascript: void(0)' class='edit_cat' id='cat_edit_<?= $value['id']?>' title="Удалить"><i class="icon-pencil"></i></a>
	<a href='javascript: void(0)' class='del_cat' id='cat_del_<?= $value['id']?>' title="Редактировать"><i class='icon-remove'></i></a>
	<?php endif;?>
	</td>
</tr>	
<?php }?>
</table>
</div>


<div id="dialog-confirm" title="Добавить категорию контента" style='display: none'>
	<form method='post'>
	Название
	<p><input id='category_content_name' name='category_content_name' type='text' size='50' style='width: 300px'></p>
	Алиас
	<p><input id='category_content_alias' name='category_content_alias' type='text' size='50' style='width: 300px'></p>
	</form>
</div>

<div id="dialog-confirm-del" title="Подтвердите действие" style='display: none'>
	<p>Вы действительно хотите удалить эту подкатегорию?</p>
</div>

<div id="dialog-confirm-edit" title="Редактировать подкатегорию" style='display: none'>
	<form method='post'>
	Название
	<p><input id='subcategory_name' name='subcategory_name' type='text' size='50' style='width: 300px'></p>
	Алиас (для опытных пользователей)
	<p><input id='subcategory_alias' name='subcategory_alias' type='text' size='50' style='width: 300px'></p>
	</form>
</div>
 
  
<script>

function reload()
{
	$('.ui-dialog').html( "close" );				
	$('div.content_my').load('admin/content_category',function(){show()}); 
}

$(function() {
$('td.td_options a.del_cat').click(function(){
	$get_id = $(this).attr('id');
	$get_id = $get_id.replace(/[^-0-9]/gim,'');
	//alert($get_id);
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
				url: '<?= base_url();?>admin/del_content_category',
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
	
	$alias = $('.tr_'+$get_id+' .td_alias').html();
	
	$('#dialog-confirm-edit #subcategory_name').attr('value',$name);	
	$('#dialog-confirm-edit #subcategory_alias').attr('value',$alias);


	
	$(function() {
	$( "#dialog-confirm-edit" ).dialog({
      resizable: true,
      height:350,
	  width:370,
      modal: true,
      buttons: {
		"Принять изменения": function() {
			  var form_data = {
				"id":$get_id,
				"name":$("#dialog-confirm-edit #subcategory_name").val(),
				"category":$("#dialog-confirm-edit #subcategory_alias").val()				
		        };
				if (form_data.name !='' && form_data.category != '') {
				$.ajax({
				dataType: 'json',
				type:'POST',
				data:'json_data=' + $.toJSON(form_data),
				url: '<?= base_url();?>admin/edit_content_category',
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
    $('#add_content_category_btn_open_dlg').click(function(){
	$( "#dialog-confirm" ).dialog({
      resizable: false,
      height:350,
	  width:370,
      modal: true,
      buttons: {
        "Добавить категорию контента": function() {
				var form_data = {
				"name":$("#dialog-confirm #category_content_name").val(),
				"category":$("#dialog-confirm #category_content_alias").val()
		        };
				console.log(form_data);
				if (form_data.name !='' && form_data.category !='' ) {
				$.ajax({
				dataType: 'json',
				type:'POST',
				data:'json_data=' + $.toJSON(form_data),
				url: '<?= base_url();?>admin/add_content_category',
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
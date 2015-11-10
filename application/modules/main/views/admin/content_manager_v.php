<div class='content_page'>
<h2>Контен4т</h2>

<a href='javascript: void(0)' id='add_content_btn_open_dlg'>+ Добавить контент</a>

<table class="table table-condensed table-hover table-striped table-bordered">
<thead>
	<th>Название</th>
	<th>Описание</th>
	<th>Текст</th>
	<th>Категория</th>
	<th>Опции</th>
</thead>
<?php
foreach ($content_manager as $value){?>
<tr class='tr_<?= $value['id']?>'>
<td class='td_title'><?= $value['title'] ?></td>
	<td class='td_description'><?= $value['description'] ?></td>
	<td class='td_alias'><?= $value['id'] ?></td>
	<td class='td_alias'><?= $value['category'] ?></td>
	<td class='td_options'>
	
	<a href='javascript: void(0)' class='edit_cat' id='cat_edit_<?= $value['id']?>' title="Удалить"><i class="icon-pencil"></i></a>
	<a href='javascript: void(0)' class='del_cat' id='cat_del_<?= $value['id']?>' title="Редактировать"><i class='icon-remove'></i></a>
	
	</td>
</tr>	
<?php }?>
</table>
<a href='javascript: void(0)' id='page_prev'><- туда</a>
<a href='javascript: void(0)' id='page_next'>сюда -></a>

</div>

<div id="dialog-confirm" title="Добавить категорию контента" style='d3isplay: none'>

</div>

  
<script>
CKEDITOR.replace('editor1');
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
    $('#add_content_btn_open_dlg').click(function(){
		$windowheight = window.screen.height;		
		$windowheight = $windowheight * 0.8;		
		$windowidth = window.screen.width;
		$windowidth = $windowidth * 0.9;
		//alert('height: '+$windowheight+';width: '+$windowidth);
	$( "#dialog-confirm" ).dialog({
      resizable: true,
      height: $windowheight,
	  width: $windowidth,
      modal: true,
      buttons: {
        "Добавить контент": function() {
				var form_data = {
				"name":$("#dialog-confirm #category_content_name").val(),
				"category":$("#dialog-confirm #category_content_alias").val()
		        };
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
<div class='content_page'>
<h2>Контент</h2>

<!--<a href='javascript: void(0)' id='add_content_btn_open_dlg'>+ Добавить контент</a>-->
<!--
<table class="table table-condensed table-hover table-striped table-bordered">
<thead>
	<th>Название</th>
	<th>Описание</th>
	<th>Текст</th>
	<th>Опции</th>
</thead>
<?php
foreach ($content_manager as $value){?>
<tr class='tr_<?= $value['id']?>'>
<td class='td_title'><?= $value['title'] ?></td>
	<td class='td_description'><?= $value['description'] ?></td>
	<td class='td_alias'><?= $value['id'] ?></td>
	<td class='td_options'>
	
	<a href='javascript: void(0)' class='edit_cat' id='cat_edit_<?= $value['id']?>' title="Удалить"><i class="icon-pencil"></i></a>
	<a href='javascript: void(0)' class='del_cat' id='cat_del_<?= $value['id']?>' title="Редактировать"><i class='icon-remove'></i></a>
	
	</td>
</tr>	
<?php }?>
</table>-->
	<form method='post' id='add_content_form'>
	Заголовок title
	<p><input id='content_name' name='title' type='text' size='50' style='width: 300px'></p>
	SEO-Описание description
	<p><input id='content_name' name='description' type='text' size='50' style='width: 300px'></p>
	Ключевые слова (keywords)
	<p><input id='content_name' name='keywords' type='text' size='50' style='width: 300px'></p>
	Содержимое fulltext
	<textarea class="ckeditor" id="editor1" name='fulltext'>
	

	</textarea>
	
	Дата () date
	<?php $current_date = date('H:i:s');?>
	<p><input id='datepick' name='date' type='text' size='50' style='width: 300px' value="<?= $current_date?>"></p>
	Опубликовано (show)
	<p><input id='content_name' name='show' type='text' size='50' style='width: 300px'></p>
	Автор author
	<p><input id='content_name' name='author' type='text' size='50' style='width: 300px'></p>
	Алиас alias
	<p><input id='content_name' name='alias' type='text' size='50' style='width: 300px'></p>
	Категория category
	
	<p>
	<select name='category'>
		<option value='0'><i>Не выбрано</i></option>
	<?php foreach ($content_category_list as $value): ?>
	  <option value='<?= $value['id']?>'><?= $value['name']?></option>
	<?php endforeach;?>
	  
	</select>
	</p>
	
	
	Просмотры visit_counter
	<p><input id='content_name' name='visit_counter' type='text' size='50' style='width: 300px'></p>
	Content preview
	<p>
	<img id="preview_img_1" src="#" alt="your image" style='display: none;'/>
	<!--<label>
		<input id='image_selector_1' type='file' name='userfile_1' style='width: 125px; height: 100px; opacity: 1;'>
	  </label>-->
	<div class='kc_editor_trigger' id="image_1" onclick="openKCFinder(this)"><div style="margin:5px">Click here to choose an image</div></div>
	<input type='hidden' name='image' id='img_1'>
	
	</p>

	
	
	
	
	
	<a id='check_form_data' href='javascript: void(0)'>Добавить контент +</a>
	</form>

</div>

<div id="dialog-confirm" title="Подтверждение действия" style='display: none'>
	<p>Добавить контент?<p>
</div>

<style>  
img#img{
	width: 50px;
	margin: 0px ;
	margin-left: 0px !important; 
	margin-top: 0px !important; 
}
</style> 
<script>

  </script> 
<script>
  $(function() {
    $( "#datepick" ).datepicker();
	$( "#datepick" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	$( "#datepick").change(function(){
		$current_data = $( "#datepick").attr('value');		
		$current_data = $current_data+' <?= $current_date?>';
		$( "#datepick").attr('value',$current_data);
	})
  });

function getTime() {
    var now     = new Date();     
    var hour    = now.getHours();
    var minute  = now.getMinutes();
    var second  = now.getSeconds(); 
    
    
    if(hour.toString().length == 1) {
        var hour = '0'+hour;
    }
    if(minute.toString().length == 1) {
        var minute = '0'+minute;
    }
    if(second.toString().length == 1) {
        var second = '0'+second;
    }   
    var dateTime = hour+':'+minute+':'+second;   
     return dateTime;
}


CKEDITOR.replace('editor1');
function reload()
{
	$('.ui-dialog').html( "close" );				
	$('div.content_my').load('admin/add_content',function(){show()}); 
}

$('#check_form_data').click(function(){
	for ( instance in CKEDITOR.instances ) CKEDITOR.instances[instance].updateElement();	   
	var $formdata = $('form#add_content_form').serializeJSON();
	if ($formdata.category == '1') {$executor='admin/add_page';
	delete($formdata.category);
	} else {$executor='admin/add_content';}
	$(function() {    
	$( "#dialog-confirm" ).dialog({
      resizable: false,
      height:200,
	  width:370,
      modal: true,
	  
      buttons: {
		"Добавить": function() {
				$data = encodeURIComponent(JSON.stringify($formdata));
				$.ajax({
				dataType: 'json',
				type:'POST',
				data:'json_data=' + $data,
				url: '<?= base_url();?>'+$executor,
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
	
})

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

<script type="text/javascript">
function openKCFinder(div) {
$id = div.id;
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            div.innerHTML = '<div style="margin:5px">Loading...</div>';
            var img = new Image();
            img.src = url;
            img.onload = function() {
                div.innerHTML = '<img id="img" src="' + url + '" />';
                var img = document.getElementById('img');
                var o_w = img.offsetWidth;
                var o_h = img.offsetHeight;
                var f_w = div.offsetWidth;
                var f_h = div.offsetHeight;
                if ((o_w > f_w) || (o_h > f_h)) {
                    if ((f_w / f_h) > (o_w / o_h))
                        f_w = parseInt((o_w * f_h) / o_h);
                    else if ((f_w / f_h) < (o_w / o_h))
                        f_h = parseInt((o_h * f_w) / o_w);
                    img.style.width = f_w + "px";
                    img.style.height = f_h + "px";
                } else {
                    f_w = o_w;
                    f_h = o_h;
                }
                /*img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';*/
                img.style.visibility = "visible";
				$('div#'+$id).next().attr('value',url);
            }
        }
    };
    window.open('<?php base_url();?>template/kcfinder/browse.php?type=images&dir=images/public',
        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );
}
</script>
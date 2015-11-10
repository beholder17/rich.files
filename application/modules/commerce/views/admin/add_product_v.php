<div class='content_page'>
<h1>Добавить товар</h1>
<form id='add_product_form' method='post' enctype="multipart/form-data">
	<p>
	Тип товара		
	<select id='type_selector' name='type'>
		<option value='0'>Укажите тип товара</option>		
		<?php foreach ($types as $value){?>
			<option value='<?= $value['id']?>'><?= $value['title-rus'] ?></option>
		<?php }?>
	</select>
	</p>
	<p><label for='name'>Заголовок: </label><input type='text' name='name'></p>
	<p><label for='name_tr'>Заголовок (Английский): </label><input type='text' name='name_tr'></p>
	<p>Описание: <textarea name='description'></textarea></p>
	<p>Описание (Английский): <textarea name='description_tr'></textarea></p>
	
	
	
	<p><input type="checkbox" name="novelty" id='novelty'> <label for='novelty'>Новинка</label></p>
	<p><input type="checkbox" name="recommended" id='recommended'> <label for='recommended'>Рекомендуемый товар</label> </p>
	<p><input type="checkbox" name="promo" id='promo'> <label for='promo'>Акция</label></p>
	<br>
	<a id='add_product_form_send' class='btn btn-large btn-success' href='javascript:void(0)'>Добавить товар</a>
	
	<br><br>
	<div id="tabs" style='min-height: 400px;'>
	  <ul>
		<li><a href="#tabs-1">Общие</a></li>
		<li><a href="#tabs-2">Цены</a></li>
		<li><a href="#tabs-3">SEO</a></li>
		<li><a href="#tabs-5">Изображение</a></li>
		<li><a href="#tabs-4">Специальные</a></li>
		
		
	  </ul>
	  <div id="tabs-1">
			<p>Артикул: <input type='text' name='sku'></p>
			
	
		<p>
		Категория
		<select name='category'>
			<option value='0'>Укажите категорию</option>
			<?php foreach ($categories as $value):?>
			<option value='<?= $value['id'];?>'><?= $value['name'];?></option>
			<?php endforeach;?>
		</select>
		</p>
		<p>
		Подкатегория
		<select name='subcategory'>s
			<option value='0'>Укажите подкатегорию</option>
			<?php foreach ($subcategories as $value):?>
			<option value='<?= $value['id'];?>'><?= $value['name'];?></option>
			<?php endforeach;?>
		</select>
		</p>
		<p>
		Статус
		<select name='status'>
			<option value=''>Укажите статус</option>
			<option value='1'>Опубликован</option>
			<option value='0'>Скрыт</option>
		</select>
		</p>
	  </div>
	  <div id="tabs-2">
		<div>Цена (USD): <input type='text' name='price-usd'></div>
		<div>Цена по акции (USD): <input type='text' name='price-usd-promo'></div>
		<!--<div>Цена (TRY): <input type='text' name='price-try'></div>
		<div>Цена по акции (TRY): <input type='text' name='price-try-promo'></div>-->
		<div>Цена (RUB): <input type='text' name='price-rub'></div>
		<div>Цена по акции (RUB): <input type='text' name='price-rub-promo'></div>
	  </div>
	  <div id="tabs-3">
	   <p>SEO title: <textarea name='seo_title'></textarea></p>
		<p>SEO description: <textarea name='seo_description'></textarea></p>
		<p>SEO keywords: <textarea name='seo_keywords'></textarea></p>
	  </div>
	  <div id="tabs-4">
	   <div id="liquids_and_gels" style='display: none'>
			<p>Объем: <input name='volume' type='text'></p>
	   </div>
	   <div id="tools" style='display: none'>
			<p>Материал: <input name='material_1' type='text'></p>
			<p>Ширина: <input name='width' type='text'></p>
			<p>Высота: <input name='height' type='text'></p>
			<p>Толщина: <input name='thickness' type='text'></p>
			<p>Вес: <input name='weight' type='text'></p>
	   </div>
	   <div id="instruments" style='display: none'>
			<p>Материал: <input name='material_2' type='text'></p>
			<p>Абразивность: <input name='abrasiveness' type='text'></p>
	   </div>
	  </div>
	  <div id="tabs-5">
	  <p>Изображение: 
	  <label style='background-color: red; width: 100px; height: 100px'>
		<input id='image_selector' type='file' name='userfile' style='width: 100px; height: 100px; opacity: 0.2;'>
	  </label>
	  </p>
		<a class='img' id='op' href='javascript: void(0)'>Загрузить изображение</a>
		 <img id="preview_img" src="#" alt="your image" style='display: none;'/>
	  </div>
	</div>
	
</form>

<style>
	#preview_img{
		width: 50%
		height: 50%;
		max-width: 200px;
		max-height: 200px;
	}
</style>

<div id="dialog-confirm" title="Подтверждение действия" style='display: none'>
	<p>Добавить товар?<p>
</div>


</div>

<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
			reader.onloadstart = function (){ $('#tabs-5').css('color','red');}
            reader.onload = function (e) {
				$('#preview_img').css('display', 'inline-block');
				$('#tabs-5').css('color','black');
                $('#preview_img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image_selector").change(function(){
        readURL(this);
    });
	
	
	

  $('#op').click(function(){
	  
    var file_data = $('#image_selector').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('userfile', file_data);
    //alert(form_data.file);
    $.ajax({
                url: 'http://rich_t.ru/admin/file_upload_ci', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                //alert(php_script_response); // display response from the PHP script, if any
				/*if (php_script_response=='1') alert('ok');
				if (php_script_response=='0') alert('nope');*/
				alert (php_script_response);
                }
     });

  });


function reload()
{
	$('.ui-dialog').html( "close" );				
	$('div.content_my').load('admin/add_product',function(){show()});
//	window.history.back();
}

function hide_special_fields()
{
	$('#liquids_and_gels').css('display','none');
	$('#tools').css('display','none');
	$('#instruments').css('display','none');
}

$('#type_selector').change(function(){
	$value_type = $('#type_selector :selected').val();
	hide_special_fields();
	if ($value_type==2) $('#liquids_and_gels').css('display','inline-block');
	if ($value_type==3) $('#tools').css('display','inline-block');
	if ($value_type==4) $('#instruments').css('display','inline-block');
})

  $(function() {
    $( "#tabs" ).tabs();
  });
  CKEDITOR.replace('description');
  CKEDITOR.replace('description_tr');
  
  
  $('#add_product_form_send').click(function(){
	for ( instance in CKEDITOR.instances ) CKEDITOR.instances[instance].updateElement();	   
	var $formdata_all = $('form#add_product_form').serializeJSON();
	$formdata_all.file = $('#image_selector').prop('files')[0];	
	if ($formdata_all.file==null) $formdata_all.file = '';
	$formdata_all.image = $formdata_all.file.name;
	delete($formdata_all.file);
	

	if ($formdata_all.material_1) {$formdata_all.material = $formdata_all.material_1;}
	if ($formdata_all.material_2) {$formdata_all.material = $formdata_all.material_2;}
	delete($formdata_all.material_1);
	delete($formdata_all.material_2);

	
	$(function() {
	$( "#dialog-confirm" ).dialog({
      resizable: false,
      height:200,
	  width:370,
      modal: true,
      buttons: {
		"Добавить": function() {
				    var file_data = $('#image_selector').prop('files')[0];   
					if (file_data) {
					var form_data = new FormData();                  
					form_data.append('userfile', file_data);
					
					console.log(form_data+' - '+file_data);
					$.ajax({
								url: '<?= base_url();?>'+'admin/file_upload_ci',
								dataType: 'text',  // what to expect back from the PHP script, if anything
								cache: false,
								contentType: false,
								processData: false,
								data: form_data,                         
								type: 'post',
								success: function(php_script_response){
								$msg = JSON.parse(php_script_response);								
								console.log($msg);
								/*
								console.log('filename: '+$msg.upload_data.file_name);
								console.log('formdata_all.image: '+$formdata_all.image);
								*/
								$formdata_all.image = $msg.upload_data.file_name;
								//console.log('formdata_all.image !: '+$formdata_all.image);
								
								

									$data = encodeURIComponent(JSON.stringify($formdata_all));
									$.ajax({
									//dataType: 'json',
									type:'POST',
									data:'json_data=' + $data,
									url: '<?= base_url();?>'+'admin/add_product',
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
								}
					 });
				} else alert('не выбрано изображение');
				
				
				
		   },
        "Отмена": function() {
          $( this ).dialog( "close" );
        }
	  }

});
});
	
})
  </script>


 

 

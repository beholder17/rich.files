<?php 
$path_info = pathinfo(base_url().'assets/img/products/'.$product[0]['image']);
$img_thumb = $path_info['filename'].'_thumb.'.$path_info['extension'];

?>
<div class='content_page'>
<h1>Редактировать товар</h1>
<?php //print_r($product); ?>
<form id='add_product_form' method='post' enctype="multipart/form-data">
	<input type='hidden' name='change' value='changes_exists'>
	<p>
	Тип товара		
	<select id='type_selector' name='type'>
		<option value='0'>Укажите тип товара</option>		
		<?php foreach ($types as $value){?>
			<option <?php if ($value['id']==$product[0]['type']) echo "selected";?> value='<?= $value['id']?>'><?= $value['title-rus'] ?></option>
		<?php }?>
	</select>
	</p>
	<p><label for='name'>Заголовок: </label><input type='text' name='name' value='<?= $product[0]['name'];?>'></p>
	<p><label for='name_tr'>Заголовок (Англ): </label><input type='text' name='name_tr' value='<?= $product[0]['name_tr'];?>'></p>
	<p>Описание: <textarea name='description'><?= $product[0]['description'];?></textarea></p>
	<p>Описание (Англ): <textarea name='description_tr'><?= $product[0]['description_tr'];?></textarea></p>
	
	
	
	<p><input type="checkbox" name="novelty" id='novelty' <?php if ($product[0]['novelty']=='on') echo "checked='checked'";?>> <label for='novelty'>Новинка</label></p>
	<p><input type="checkbox" name="recommended" id='recommended' <?php if ($product[0]['recommended']=='on') echo "checked='checked'";?>> <label for='recommended'>Рекомендуемый товар</label> </p>
	<p><input type="checkbox" name="promo" id='promo' <?php if ($product[0]['promo']=='on') echo "checked='checked'";?>> <label for='promo'>Акция</label></p>
	<br>
	<a id='edit_apply_product_form_send' class='btn btn-large btn-success' href='javascript:void(0)'>Сохранить</a>
	<br><br>
	<a id='' class='btn btn-success' href='javascript:del_product(<?= $product[0]['id']?>)'>Удалить товар</a>
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
			<p><label for='sku'>Артикул:</label> <input type='text' name='sku' value='<?= $product[0]['sku'];?>'></p>
			
	
		<p>
		<label for='category'>Категория</label>
		<select name='category'>
			<option value='0'>Укажите категорию</option>
			<?php foreach ($categories as $value):?>
			<option <?php if ($value['id']==$product[0]['category']) echo "selected";?> value='<?= $value['id'];?>'><?= $value['name'];?></option>
			<?php endforeach;?>
		</select>
		</p>
		<p>
		<label for='subcategory'>Подкатегория</label>
		<select name='subcategory'>s
			<option value='0'>Укажите подкатегорию</option>
			<?php foreach ($subcategories as $value):?>
			<option <?php if ($value['id']==$product[0]['subcategory']) echo "selected";?> value='<?= $value['id'];?>'><?= $value['name'];?></option>
			<?php endforeach;?>
		</select>
		</p>
		<p>
		<label for='status'>Статус</label>
		<select name='status'>
			<option value=''>Укажите статус</option>
			<option <?php if ($product[0]['status']==1) echo "selected";?> value='1'>Опубликован</option>
			<option <?php if ($product[0]['status']==0) echo "selected";?> value='0'>Скрыт</option>
		</select>
		</p>
	  </div>
	  <div id="tabs-2">
	  <div class='fields_style'>
		<div><label for='price-usd'>Цена (USD):</label> <input type='text' name='price-usd' value='<?= $product[0]['price-usd'];?>'></div>
		<div><label for='price-usd-promo'>Цена по акции (USD):</label> <input type='text' name='price-usd-promo' value='<?= $product[0]['price-usd-promo'];?>'></div>
		<!--<div>Цена (TRY): <input type='text' name='price-try' value='<?= $product[0]['price-try'];?>'></div>
		<div>Цена по акции (TRY): <input type='text' name='price-try-promo' value='<?= $product[0]['price-try-promo'];?>'></div>-->
		<div><label for='price-rub'>Цена (RUB):</label> <input type='text' name='price-rub' value='<?= $product[0]['price-rub'];?>'></div>
		<div><label for='price-rub-promo'>Цена по акции (RUB):</label> <input type='text' name='price-rub-promo' value='<?= $product[0]['price-rub-promo'];?>'></div>
	  </div>
	  </div>
	  <div id="tabs-3">
	   <p><label for='seo_title'>SEO title:</label> <textarea name='seo_title'><?= $product[0]['seo_title'];?></textarea></p>
		<p><label for='seo_description'>SEO description:</label> <textarea name='seo_description'><?= $product[0]['seo_description'];?></textarea></p>
		<p><label for='seo_keywords'>SEO keywords:</label> <textarea name='seo_keywords'><?= $product[0]['seo_keywords'];?></textarea></p>
	  </div>
	  <div id="tabs-4">
	   <div id="liquids_and_gels" style='display: none'>
			<p><label for='volume'>Объем:</label> <input name='volume' type='text' value='<?= $product[0]['volume'];?>'></p>
	   </div>
	   <div id="tools" style='display: none'>
			<p>Материал: <input name='material_1' type='text' value='<?= $product[0]['material'];?>'></p>
			<p>Ширина: <input name='width' type='text' value='<?= $product[0]['width'];?>'></p>
			<p>Высота: <input name='height' type='text' value='<?= $product[0]['height'];?>'></p>
			<p>Толщина: <input name='thickness' type='text' value='<?= $product[0]['thickness'];?>'></p>
			<p>Вес: <input name='weight' type='text' value='<?= $product[0]['weight'];?>'></p>
	   </div>
	   <div id="instruments" style='display: none'>
			<p>Материал: <input name='material_2' type='text'></p>
			<p>Абразивность: <input name='abrasiveness' type='text'></p>
	   </div>
	  </div>
	  <div id="tabs-5">
	  <p>Изображение: 
	  <label style='background-color: red; width: 100px; height: 100px'>
		<input id='image_selector' type='file' name='userfile' value='<?= $product[0]['image']; ?>' style='width: 100px; height: 100px; opacity: 0.2;'>
		<input id='image_selector_hidden' type='hidden' value='<?= $product[0]['image']; ?>'>
	  </label>
	  </p>
		<a class='img' id='op' href='javascript: void(0)'>Загрузить изображение</a>
		 <img id="preview_img" src="<?= base_url();?>assets/img/products/thumbs/<?= $img_thumb;?>" alt="your image"/>
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

<div id="dialog-confirm" title="Подтверждение действия" style='display: none'><p>Применить изменения?<p></div>
<div id="dialog-changes-applied" title="Подтверждение действия" style='display: none'><p>Изменения внесены<p></div>


</div>
<?php $link_to_redirect = base_url().'catalog';?>
<script>
function del_product($var)
{
	//alert($var);
	var isAdmin = confirm("Удалить товар? (отмена действия не возможна)");
	if (isAdmin==true) {
		//alert( 'удален' );
		 $.ajax({
                url: '<?=base_url()?>admin/del_product', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                //cache: false,
                //contentType: false,
                //processData: false,
                data: 'todel='+$var, 
                type: 'post',
                success: function(){
                window.location.href = "<?=$link_to_redirect?>";
				alert( 'Товар удален' );
                }
		});
		}
	
}

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
                //url: 'http://rich_t.ru/admin/file_upload_ci', // point to server-side PHP script 
				url: 'http://richworlds-st.ru/admin/file_upload_ci', // point to server-side PHP script 
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
	//$('div.content_my').load('admin/add_product',function(){show()}); 
	//$('body').load('admin/',function(){show()});
	window.history.back();
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
  
  CKEDITOR.replace('description','config.js');
  CKEDITOR.replace('description_tr','config.js');
  
  
  
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
								$formdata_all.image = $msg.upload_data.file_name;
									$data = encodeURIComponent(JSON.stringify($formdata_all));
									$.ajax({
									dataType: 'json',
									type:'POST',
									data:'json_data=' + $data,
									url: '<?= base_url();?>'+'admin/edit_product',
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


 $('#edit_apply_product_form_send').click(function(){
	
//	$img_change = true;
	for ( instance in CKEDITOR.instances ) CKEDITOR.instances[instance].updateElement();	   
	var $formdata_all = $('form#add_product_form').serializeJSON();
	$formdata_all.file = $('#image_selector').prop('files')[0];	
	if ($formdata_all.file==null) {$formdata_all.image = $('#image_selector_hidden').val();	$img_change = false;} else {
	$formdata_all.image = $formdata_all.file.name;}
	if ($formdata_all.image == '<?= $product[0]['image']?>') $img_change = false; else $img_change = true;
	
	delete($formdata_all.file);
	

	if ($formdata_all.material_1) {$formdata_all.material = $formdata_all.material_1;}
	if ($formdata_all.material_2) {$formdata_all.material = $formdata_all.material_2;}
	delete($formdata_all.material_1);
	delete($formdata_all.material_2);

	 console.log($formdata_all);
	$(function() {
	$( "#dialog-confirm" ).dialog({
      resizable: false,
      height:200,
	  width:370,
      modal: true,
      buttons: {
		"Добавить": function() {
			
				    var file_data = $('#image_selector').prop('files')[0];   
					//if (file_data) {
					var form_data = new FormData();                  
					form_data.append('userfile', file_data);
					if ($img_change == false) form_data.append('change','no_changes'); else form_data.append('change','changes_exists');
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
								if ($img_change != false) $formdata_all.image = $msg.upload_data.file_name;
									$data = encodeURIComponent(JSON.stringify($formdata_all));
									$.ajax({
									//dataType: 'json',
									type:'POST',
									data:'json_data=' + $data +'&id=<?= $id?>',
									url: '<?= base_url()?>'+'admin/edit_product',
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
					 });
				
				
				
				
		   },
        "Отмена": function() {
          $( this ).dialog( "close" );
        }
	  }

});
});
	
})
  </script>


 

 

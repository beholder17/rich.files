<div class='content_page'>
<h1>Редактировать слайдер</h1>
<?php //print_r($slider[0]['id']); 
//echo "<br>";
$count = count (unserialize($slider[0]['data']));
$data = unserialize($slider[0]['data']);
?>
<form id='add_slider_form' method='post' enctype="multipart/form-data">
	<p><label for='name'>Заголовок: </label><input style='width: 600px;' type='text' name='name' value='<?= $slider[0]['title'] ?>'></p>
	<p><label for='destination'>Целевая страница: </label><input style='width: 600px;' type='text' name='destination' value='<?= $slider[0]['destination'] ?>'></p>
	
	
	
	
	<p><input type="checkbox" name="status" id='status' <?php
	if ($slider[0]['status']=='1') echo 'checked';
	?>> <label for='status'>Активный?</label></p>
	
	<br>
	
	<br><br>
	
	  


<table class='table'>	
<?php foreach($data as $key=>$value){ $inc = $key+1;?>
<tr id='first_row'>

	<td>
	
	<!--<label>
		<input id='image_selector_1' type='file' name='userfile_1' style='width: 125px; height: 100px; opacity: 1;'>
	  </label>-->
	<div class='kc_editor_trigger' id="image_<?=$inc?>" onclick="openKCFinder(this)">
	<img id="preview_img_<?=$inc?>" src="<?= base_url().$value['img']?>" alt="your image" style='max-width: 160px;'/>
	<div style="margin:5px">Click here to choose an image</div></div>
	<input type='hidden' name='img_<?=$inc?>' id='img_<?=$inc?>' value='<?= $value['img']?>'>
	
	</td>
	<td><p><label for='alt_<?=$inc?>'>alt: </label><input type='text' name='alt_<?=$inc?>' value='<?= $value['img_alt']?>'></p></td>
	<td><p><label for='title_<?=$inc?>'>title: </label><input type='text' name='title_<?=$inc?>'  value='<?= $value['img_title']?>'></p></td>
	<td><p><label for='link_<?=$inc?>'>URL страницы: </label><input type='text' name='link_<?=$inc?>'  value='<?= $value['link']?>'></p></td>
	<td><div class='remove_row'>-</div></td>
	</tr>
<?php } ?>


</table>	
<style type="text/css">

</style>
Add slide: <div id='add_new_img'>+</div>

		
		 
<a id='add_slider_form_send' class='btn btn-large btn-success' href='javascript:void(0)'>Применить изменения</a>
	
	
</form>

<style>
	#preview_img{
		width: 50%
		height: 50%;
		max-width: 200px;
		max-height: 200px;
	}
	#add_new_img, .remove_row{
		font-size: 30px;
		cursor: pointer;
	}
	
#image {
    width: 200px;
    height: 200px;
    overflow: hidden;
    cursor: pointer;
    background: #000;
    color: #fff;
}
#image img {
    visibility: hidden;
}
.remove_row{display: none;}
.table tr:last-child .remove_row{
	display: block;
	
}
</style>

<div id="dialog-confirm" title="Подтверждение действия" style='display: none'>
	<p>Применить изменения?<p>
</div>


<?php //if ($grocery) echo ($grocery);?>
</div>

<script>
$('.remove_row').click(function(){
	$tmp = $(this).parent().parent().parent().html();
	//alert($tmp);
	
		$tmp = $(this).parent().parent().parent().html();
		$(this).parent().parent().remove();
	
});


//$(document).ready(function(){
		
	$('#add_new_img').click(function(){
	$count = $(".table tr").length+1;

	$new_cell = "<tr><td><div id='image_"+$count+"' onclick='openKCFinder(this)'><div style='margin:5px'>Click here to choose an image</div></div><input type='hidden' name='img_"+$count+"' id='img_"+$count+"'></td><td><p><label for='alt_"+$count+"'>alt: </label><input type='text' name='alt_"+$count+"'></p></td><td><p><label for='title_"+$count+"'>title: </label><input type='text' name='title_"+$count+"'></p></td><td><p><label for='link'>URL страницы: </label><input type='text' name='link_"+$count+"'></p></td><td><div class='remove_row'>-</div></td></tr>";
	
	$( "tbody" ).append($new_cell);
	
	$('.remove_row').unbind('click').bind('click',function(){
		$tmp = $(this).parent().parent().parent().html();
		$(this).parent().parent().remove();
	}); 
	
	$('#image_selector_'+$count).bind('change',function(){
		readURL(this,$count);

		console.log(this+'>>>>>>	'+$count);
	}); 
});

//});


function reload()
{
	$('.ui-dialog').html( "close" );				
	$('div.content_my').load('admin/add_slider',function(){show()}); 
}

  
  $('#add_slider_form_send').click(function(){
	/* количество страниц слайдера */
	$count = $(".table tr").length;
	var $formdata_all = $('form#add_slider_form').serializeJSON();

	$(function() {
	$( "#dialog-confirm" ).dialog({
      resizable: false,
      height:200,
	  width:370,
      modal: true,
      buttons: {
		"Добавить": function() {
									$data = encodeURIComponent(JSON.stringify($formdata_all));
									$.ajax({
									//dataType: 'json',
									dataType: 'text',
									type:'POST',
									data:'json_data=' + $data+'&id=<?=$slider[0]['id']?>',
									url: '<?= base_url();?>'+'admin/edit_slider',
									success: function($ret){
									//reload();
									window.history.back(1);
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
                div.innerHTML = '<img style="max-width: 160" id="img" src="' + url + '" />';
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
                img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
                img.style.visibility = "visible";
				$('div#'+$id).next().attr('value',url);
            }
        }
    };
    window.open('http://richworld-st.ru/template/kcfinder/browse.php?type=images&dir=images/public',
        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );
}
</script>
<div class='content_page'>
<h1>Добавить слайдер</h1>
<form id='add_slider_form' method='post' enctype="multipart/form-data">
	<p><label for='name'>Заголовок: </label><input type='text' name='name'></p>
	<p><label for='destination'>Целевая страница: </label><input type='text' name='destination'></p>
	
	
	
	
	
	<p><input type="checkbox" name="status" id='status'> <label for='status'>Активный</label></p>
	
	<br>
	
	<br><br>
	
	  


<table class='table'>	

<tr id='first_row'>
	<td>
	<img id="preview_img_1" src="#" alt="your image" style='display: none;'/>
	<!--<label>
		<input id='image_selector_1' type='file' name='userfile_1' style='width: 125px; height: 100px; opacity: 1;'>
	  </label>-->
	<div class='kc_editor_trigger' id="image_1" onclick="openKCFinder(this)"><div style="margin:5px">Click here to choose an image</div></div>
	<input type='hidden' name='img_1' id='img_1'>
	</td>
	<td><p><label for='alt_1'>alt: </label><input type='text' name='alt_1'></p></td>
	<td><p><label for='title_1'>title: </label><input type='text' name='title_1'></p></td>
	<td><p><label for='link'>URL страницы: </label><input type='text' name='link_1'></p></td>
	<td></td>

<style type="text/css">
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
</style>
</tr>
</table>	
Add slide: <div id='add_new_img'>+</div>
	  
		 
<a id='add_slider_form_send' class='btn btn-large btn-success' href='javascript:void(0)'>Добавить слайдер</a>
	
	
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
</style>

<div id="dialog-confirm" title="Подтверждение действия" style='display: none'>
	<p>Добавить слайдер?<p>
</div>
<div id="dialog-confirm" title="Warning" style='display: none'>
	<p>Укадите заголовок слайдера<p>
</div>

</div>

<script>
$('.remove_row').click(function(){
	$tmp = $(this).parent().parent().html();
	alert($tmp);
});


$(document).ready(function(){
		
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

});


function reload()
{
	$('.ui-dialog').html( "close" );				
	$('div.content_my').load('admin/add_slider',function(){show()}); 
}

  
  $('#add_slider_form_send').click(function(){
	  
	/* количество страниц слайдера */
	$count = $(".table tr").length;
	var $formdata_all = $('form#add_slider_form').serializeJSON();

	if ($formdata_all.name=='') {alert('Не указан заголовок');} else {

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
									dataType: 'json',
									type:'POST',
									data:'json_data=' + $data,
									url: '<?= base_url();?>'+'admin/add_slider',
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
        "Отмена": function() {
          $( this ).dialog( "close" );
        }
	  }

});
});
	}
	
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
                img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
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
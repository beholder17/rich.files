<h1 class='lined'><span>Авторизация</span></h1>

<form id='auth_form' name="auth_form" method="post" action="javascript:void(0);">
	<p><label for='email_auth'>E-mail</label><input id='email_auth' name='email_auth' id="login_frm" type="text" size="30" placeholder="Ваш логин" value=''></p>
	<p><label for='pw_auth'>Пароль</label><input id='pw_auth' name='pw_auth' id="password_frm" type="password" size="30" placeholder="Введите пароль" value=''></p>
	<p><label for='captcha_auth'>Код с картинки</label><input id='captcha_auth' name='captcha_auth' id="captcha_frm" type="text" size="30" placeholder="Введите цифры с картинки"></p>
	<p style='padding-left: 137px;'><?php echo $image;?></p>
	<p style='padding-left: 137px;'><input class='btn_v2' type="submit" value="Отправить" id='auth_button'></p>
	<p>
	<?php //echo $random_string_for_captcha; ?>
	</p>
</form>
<p style='padding-left: 137px;'><a href='<?=base_url().$this->uri->segment(1)?>/auth/forget'>Забыли пароль?</a></p>
<p style='padding-left: 137px;'><a href='<?=base_url().$this->uri->segment(1)?>/auth/registration'>Регистрация</a></p>
<div id="dialog-message" title=""></div>

<script>

function auth_info_window($auth_window_header,$window_content,$reload_page)
{
	$(function(){
		$('#dialog-message').html($window_content);
		$('#dialog-message').attr('title',$auth_window_header);
				$( "#dialog-message" ).dialog({
				  modal: true,
				  buttons: {
					Ok: function() {
					  $( this ).dialog( "close" );
					  if ($reload_page==true) location.reload(true);
					  if ($reload_page==3) $('#captcha_auth').val('');
					  if ($reload_page==5) window.location.replace("<?php base_url().$this->uri->segment(1)?>/auth/account");
					}
				  }
				});
			  });
}

$(document).ready(function(){
    $('#auth_button').click(function(){
		
		/*$email_auth = $("#email_auth").val();
		$pw_auth = $("#pw_auth").val();
		*/
		//alert('fd');
		if ($("#email_auth").val()=='' || $("#pw_auth").val()=='' || $("#captcha_auth").val()==''){
			auth_info_window('Ошибка!','<p>Укажите ваши e-mail, пароль и цифры с картинки</p>',false);
			exit();
			}

		
		var form_data = {
		"email_auth":$("#email_auth").val(),
		"pw_auth":$("#pw_auth").val(),
		"captcha_auth":$("#captcha_auth").val()
        };
		
		/*if ($form_data['email_auth']=='' || $form_data['pw_auth']==''){alert('Заполните форму авторизации');} else {
		alert('send');
		alert($form_data['email_auth']);
		alert($form_data['pw_auth']);	*/
		//alert($.toJSON(form_data));	
		console.log($.toJSON(form_data));
		$.ajax({
		dataType: 'json',
		type:'POST',
		data:'json_data=' + $.toJSON(form_data),
		//url: 'response.php?action=sample5',
		//url: 'auth/auth_check',
		url: '<?= base_url().$this->uri->segment(1);?>/auth/auth_check_ajax',
		success: function(jsondata){
			//$('#auth_button').html('Name = ' + jsondata.name + ', Nickname = ' + jsondata.nickname);
			//alert(jsondata);
			//alert('success!');
			$('.h_l1_b1').html('Name = '+jsondata.auth_result);
			//alert(jsondata.auth_result);
		if (jsondata.auth_result==1) {
			auth_info_window('Вы авторизованы!','<p>Добропожаловать, '+jsondata.name+' '+jsondata.otch+'</p>',5);
			if (jsondata.personal_auth==1) {}
		} 
		
		if (jsondata.auth_result==0) { auth_info_window('Авториязация не прошла!','<p>Не верный логин или пароль! Повторите попытку</p>',true);}
		if (jsondata.auth_result==2) { auth_info_window('Авториязация не прошла!','<p>Количество попыток авторизации превысило предельно допустимое.</p>',2);}
		if (jsondata.auth_result==3) { auth_info_window('Авториязация не прошла!','<p>Не правильно введены цифры с картинки</p>',3);}
			
			

			
			
				
		},
		error: function($exception){
			//$('#auth_button').html('Name = ' + jsondata.name + ', Nickname = ' + jsondata.nickname);
			//alert(jsondata);
			alert('error!');
			alert('Exeption:'+$exception);
			alert ($exception);
		},
		done: function(){
			//$('#auth_button').html('Name = ' + jsondata.name + ', Nickname = ' + jsondata.nickname);
			//alert(jsondata);
			alert('done!');
		
		}
		});
		})
	
	})

</script>
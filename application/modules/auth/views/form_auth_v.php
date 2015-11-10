<?php $this->lang->load('auth', $this->uri->segment(1)); ?>
<a href='javascript: void(0)' id='auth_form_container_run'><i class="fa fa-sign-in"></i>  <?= $this->lang->line('login');?></a> | 
<a href='<?=base_url().$this->uri->segment(1)?>/auth/registration'><i class="fa fa-arrow-circle-o-right"></i>  <?= $this->lang->line('registration');?></a>
<div id='auth_form_container' style='display: none' title="<?= $this->lang->line('authorization');?>">
<form name="auth_form" method="post" action="javascript:void(0);">
					<input id='email_auth' name='email_auth' id="login_frm" type="text" size="" placeholder="<?= $this->lang->line('enter_mail');?>">
					<input id='pw_auth' name='pw_auth' id="password_frm" type="password" size="" placeholder="<?= $this->lang->line('enter_pw');?>">
					<input type="submit" value="<?= $this->lang->line('submit');?>" id='auth_button'>					
</form>
<p id='registration_trigger' style='position: absolute; top: 30px;'><a href="<?= base_url().$this->uri->segment(1).'/auth/registration'?>"><i class="fa fa-arrow-circle-o-right"></i> <?= $this->lang->line('registration');?></a></p>
<p id='recall_trigger' style='position: absolute; absolute; top: 57px;'><a href="<?= base_url().$this->uri->segment(1).'/auth/forget'?>"><i class="fa fa-question-circle"></i> <?= $this->lang->line('forget_pw');?></a></p>
<div id="dialog-message" title=""></div>
</div>
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
					  if ($reload_page==2) window.location.replace("<?= base_url().$this->uri->segment(1).'/auth/login' ?>");
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
		
		if ($("#email_auth").val()=='' || $("#pw_auth").val()==''){
			auth_info_window('Oops!','<p>Укажите ваши e-mail и пароль</p>',false);
			exit();
			}

		
		var form_data = {
		"email_auth":$("#email_auth").val(),
		"pw_auth":$("#pw_auth").val()
        };
		
		/*if ($form_data['email_auth']=='' || $form_data['pw_auth']==''){alert('Заполните форму авторизации');} else {
		alert('send');
		alert($form_data['email_auth']);
		alert($form_data['pw_auth']);	*/
		//alert($.toJSON(form_data));	
		
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
		if (jsondata.auth_result==1) {auth_info_window('Вы авторизованы!','<p>Добропожаловать, '+jsondata.name+' '+jsondata.otch+'</p>',true);} 
		
		if (jsondata.auth_result==0) { auth_info_window('Авторизация не прошла!','<p>Не верный логин или пароль! Повторите попытку</p>',true);}
		if (jsondata.auth_result==2) { auth_info_window('Авторизация не прошла!','<p>Количество попыток авторизации превысило предельно допустимое.</p>',2);}
			
			
			
			
			
			//location.reload(true);			
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
	
		$('#auth_form_container_run').click(function(){
			
        
		
			$('#auth_form_container').dialog({			
				modal: true,
				height: 215,
				width: 400,
				resizable: false,
				beforeClose: function() {
					setTimeout(function(){
					$( ".ui-dialog" ).removeClass( "animated zoomIn" );
					$( ".ui-dialog" ).addClass( "animated zoomOut" );	
					
					}, 10);
					setTimeout(function(){
					$( ".ui-dialog" ).removeClass( "animated zoomOut" );
					}, 200);
					$( ".ui-dialog" ).css( "display",'none' );	
					},
				 close: function() {$( ".ui-dialog" ).css( "display",'block' );	
				 setTimeout(function(){
					$( ".ui-dialog" ).css( "display",'none' );	
				 },200)
				 }
				});
		$( ".ui-dialog" ).addClass( "animated zoomIn" );
		
		})
	
	})

</script>
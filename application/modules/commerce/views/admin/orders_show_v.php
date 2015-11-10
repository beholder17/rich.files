
<div class='content_page'>
<h1>Заказы</h1>
<a class='btn' id='unpaid_orders' href='javascript:void(0)'>Неоплаченные заказы</a>
<a class='btn' id='paid_orders' href='javascript:void(0)'>Оплаченные (ожидающие доставки)</a>
<a class='btn' id='history_orders' href='javascript:void(0)'>Доставленные (в истории)</a>
<table class="table table-condensed table-hover table-striped table-bordered">
<thead>
	<th style='text-align: center;' >№ заказа</th>
	<th style='text-align: center; width: 180px;'>Заказчик</th>	
	<th style='text-align: center;'>Корзина</th>
	<th style='width: 60px;'>Дата заказа</th>
	<th style='text-align: center;'>Статус заказа</th>
	<th style='text-align: center;'>Операции</th>
</thead>
	<?php foreach ($data as $order) {?>
	<tr>
		<td><?=$order['id']?></td>
		<td><a href='javascript:show_user(<?=$order['user_id'];?>)'><?=$order['famil'].' '.$order['name']."<br>".$order['adress']?></td>
		<td><!--<a href='javascript:void(0)'>Обзор заказа</a><br>-->
		<?php
		$cart = unserialize($order['cart']);
		//var_dump($cart);
		$subtotal = 0;
			foreach ($cart as $value)
			{
				$link = base_url().'en/catalog/'.$value['category_alias'].'/'.$value['subcategory_alias'].'/'.$value['id'];
				$subtotal = $subtotal + $value['subtotal'];
				$currency = $value['currency'];
				echo "<a href='$link' target='_blank'><img class='orders_preview' src='".base_url()."assets/img/products/thumbs/".$value['image']."'></a>";
				
				echo "<a href='$link' target='_blank'>".$value['name']."</a>";
			}
		if ($currency == 'en') $currency = 'USD';
		if ($currency == 'tr') $currency = 'TUR';
		
		echo "<br>Заказ на сумму: ".$subtotal.' '.$currency;
		
		?>
		</td>
		<td><?php
		echo date('d.m.Y H:i',$order['date_order_create']);
		?></td>
		<td><?php 
		if ($order['status']==1) $tmp = '<span class="label label-warning">Ожидает оплаты</span>';
		if ($order['status']==2) $tmp =  '<span class="label label-success">Оплачен</span>';
		if ($order['status']==3) $tmp =  '<span class="label">В истории</span>';
		echo $tmp;
		?>
		
		</td>
		<td>
		<p><a target='_blank' href='javascript:del_order(<?=$order['id']?>)'>Удалить заказ</a></p>
		<p><a target='_blank' href='<?=base_url()?>commerce/print_order/<?=$order['id']?>'>печать заказа</a></p>
		<p><a target='_blank' href='javascript:reload()'>Перезагрузка</a></p>
		<p><a target='_blank' href='javascript:change_status(<?=$order['id']?>)'>Изменить статус заказа</a></p>
		</td>
	</tr>
	<?php } ?>
</table>

<div id="dialog-confirm" title="" style='display: none'></div>

<div id="dialog-confirm-change-status" title="Смена статуса заказа" style='display: none;'>
<form name='change_status_form' id='change_status_form'>
	<input class='radio_status' type="radio" name="status" value="1" <?php if ($order['status']==1) echo 'checked';?>>Ожидает оплаты<Br>
	<input class='radio_status' type="radio" name="status" value="2" <?php if ($order['status']==2) echo 'checked';?>>Оплачен<Br>
	<input class='radio_status' type="radio" name="status" value="3" <?php if ($order['status']==3) echo 'checked';?>>В истории<Br>
</form>
</div>

<?php //var_dump($data); ?>
</div>
<style>
.orders_preview{
width: 75px	
}

</style>
<script>
function show_user($id){
	$('#dialog-confirm').attr('title','Информация о покупателе');
	
	$.ajax({
		url: '<?= base_url();?>'+'admin/order_get_user_info',
		dataType: 'text',
		type:'POST',
		data:'id='+$id,
		success: function(php_script_response){
		$result_query = php_script_response;
		console.log(php_script_response);
		//reload();
		$('#dialog-confirm').html($result_query);
		$( "#dialog-confirm" ).dialog({
		  resizable: false,
		  height:380,
		  width:370,
		  modal: true,
		  buttons: {		
			"OK": function() {
			  $( this ).dialog( "close" );
			}
		  }

		});
		},
		error: function($exception){
				alert('error!');
				alert('Exeption:'+$exception);
				console.log($exception);
		},
		done: function(){
				alert('done!');			
				alert('Exeption:'+$exception);
		}
	});
	
	
	
}

function reload()
{
	$('.ui-dialog').html( "close" );				
	$('div.content_my').load('commerce/orders',function(){show()}); 
}

function waiting()
{
	$('div.content_my').html('<div class="waiting" style="opacity: 0.1; position: relative;">Ожидание</div>');
	$('div.waiting').animate({opacity: 1}, 900);
}

function show() { $('div.content_page').addClass('animated zoomIn'); }

$('a#history_orders').click(function(){
				waiting(); 
				$('div.content_my').load('commerce/adm_orders/history',function(){show()}); 
});

$('a#paid_orders').click(function(){
				waiting(); 
				$('div.content_my').load('commerce/adm_orders/paid',function(){show()}); 
});

$('a#unpaid_orders').click(function(){
				waiting(); 
				$('div.content_my').load('commerce/adm_orders/unpaid',function(){show()}); 
});

function change_status($id)
{
	$( "#dialog-confirm-change-status" ).dialog({
      resizable: false,
      height:230,
	  width:370,
      modal: true,
      buttons: {
		"Применить статус заказа": function() {
					$value = $("#change_status_form input[type='radio']:checked").val();
					//alert('value '+$value);
					$.ajax({
						url: '<?= base_url();?>'+'admin/change_status_order',
						dataType: 'text',
						type:'POST',
						data:'id='+$id+'&value='+$value,
						success: function(php_script_response){
						
						//console.log($php_script_response);
						reload();
						},
						error: function($exception){
								alert('error!');
								alert('Exeption:'+$exception);
								console.log($exception);
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
}

function del_order($var)
{
		/*var person = prompt("Удаление заказа номер "+$var+"\n Введите в поле номер заказа чтобы удалить его\n (Отмена действия не возможна)", "");
		if (person != null) {
			if (person == $var) alert("del!");
		}*/
	$('#dialog-confirm').attr('title','Подтверждение действия');
	$('#dialog-confirm').html('<p>Удаление заказа №'+$var+'</p><p>Отмена действия не возможна!</p>');
	$( "#dialog-confirm" ).dialog({
      resizable: false,
      height:200,
	  width:370,
      modal: true,
      buttons: {
		"Удалить": function() {
					$.ajax({
						url: '<?= base_url();?>'+'admin/del_order',
						dataType: 'text',
						type:'POST',
						data:'json_data='+$var,
						success: function(php_script_response){
						
						//console.log($php_script_response);
						reload();
						alert('df');
						},
						error: function($exception){
								alert('error!');
								alert('Exeption:'+$exception);
								console.log($exception);
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
		
}
	
	
</script>
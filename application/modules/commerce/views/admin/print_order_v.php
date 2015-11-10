<div class='paper_page'>
<h1>Заказ №<?=$data[0]['id']?> от <?= date('d.m.Y H:i',$data[0]['date_order_create'])?></h1>
<small>Распечатано: <?= date('d.m.Y H:i');?></small>

<h2>Заказчик</h2>
<?php
foreach($user as $value)
{
	echo "Имя: ".$value['name']."<br>";
	echo "Фамилия: ".$value['famil']."<br>";
	echo "Телефон: ".$value['phone']."<br>";
	echo "Электронная почта: ".$value['email']."<br>";
	echo "Адрес: ".$value['adress']."<br>";
}
?>

<h2>Содержимое корзины</h2>
<?php

$cart = unserialize($data[0]['cart']);
$subtotal = 0;
foreach ($cart as $value)
{
	$link = base_url().'en/catalog/'.$value['category_alias'].'/'.$value['subcategory_alias'].'/'.$value['id'];
	$subtotal = $subtotal + $value['subtotal'];
	$currency = $value['currency'];
	//echo "<a href='$link' target='_blank'><img class='orders_preview' src='".base_url()."assets/img/products/thumbs/".$value['image']."'></a>";
	//echo "<a href='$link' target='_blank'>".$value['name']."</a>";
}
?>
<table class='print_table'>
	<tr class='print_table_head'>
	 <td>id товара</td>
	 <td>Изображение</td>
	 <td>Артикул</td>
	 <td>Наименование</td>
	 <td>Производитель</td>	 
	 <td>Количество</td>
	 <td>Цена за единицу</td>
	 <td>Цена за кол-во</td>
	</tr>
	<?php 
	foreach ($cart as $value)
	{
		if ($value['currency']=='en') $currency = 'USD';
		if ($value['currency']=='tr') $currency = 'TRY';
		echo "<tr>";
		echo "<td>".$value['id']."</td>";
		echo "<td><img class='orders_preview' src='".base_url()."assets/img/products/thumbs/".$value['image']."'></td>";
		echo "<td>".$value['sku']."</td>";
		echo "<td>".$value['name']."</td>";
		echo "<td>".$value['category_alias']."</td>";
		echo "<td>".$value['qty']."</td>";
		echo "<td>".$value['price'].' '.$currency."</td>";
		echo "<td>".$value['subtotal'].' '.$currency."</td>";
		
		echo "</tr>";
		
	}
	?>
</table>
	<div class='table_total'>
		<?php
		$subtotal = 0;
		foreach ($cart as $value)
			{
				$subtotal = $subtotal + $value['subtotal'];
				$currency = $value['currency'];
			}
		if ($currency == 'en') $currency = 'USD';
		if ($currency == 'tr') $currency = 'TUR';
		if ($currency == 'ru') $currency = 'RUB';
		echo "Заказ на сумму ".$subtotal." ".$currency;
		?>
	</div>
<h2>Комментарий к заказу</h2>	
<p>
<?php if ($data[0]['comment'] !=NULL) echo $data[0]['comment']; else "Покупатель не указал комментарий к заказу";?>
</p>
</div>
<?php //var_dump($data);?>
<style>
	.paper_page{
		width: 900px;
		font-family: sans-serif;
	}
	.orders_preview{
		width: 100px;
	}
	.print_table{
		width: 100%;
		border: 1px solid black;
		border-collapse: collapse;

	}
	
	.print_table_head{
		font-weight: bolder;
		text-align: center;
		color: black;
		background-color: lightgray;
	}
	.print_table td{
		border: 1px solid black;
	}
	.table_total{
		font-size: 18px;
		text-align: right;
	}
</style>
<script>
window.print();
</script>
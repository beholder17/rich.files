<?php
	if ($this->uri->segment(1)=='ru'){
		$lang_title = "Личный кабинет покупателя";
		$lang_h2 = 'Заказы пользователя';
	}
	
	if ($this->uri->segment(1)=='en'){
		$lang_title = "My orders";
		$lang_h2 = "User's orders";		
	}
?>
<?php

function pay($num_of_order,$sum)
{
	
// 2.
// Оплата заданной суммы с выбором валюты на сайте ROBOKASSA
// Payment of the set sum with a choice of currency on site ROBOKASSA

// регистрационная информация (логин, пароль #1)
// registration info (login, password #1)
$mrh_login = "vosaduli";
$mrh_pass1 = "wmR92yx2SV";

// номер заказа
// number of order
$inv_id = $num_of_order;

// описание заказа
// order description
$inv_desc = "ROBOKASSA Advanced User Guide";

// сумма заказа
// sum of order
//$out_summ = "8.96";
$out_summ = $sum;


// тип товара
// code of goods
$shp_item = "2";

// предлагаемая валюта платежа
// default payment e-currency
$in_curr = "";

// язык
// language
$culture = "ru";

// формирование подписи
// generate signature
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item");

// форма оплаты товара
// payment form
return "<html>".
      "<form action='https://merchant.roboxchange.com/Index.aspx' method=POST>".
      "<input type=hidden name=MrchLogin value=$mrh_login>".
      "<input type=hidden name=OutSum value=$out_summ>".
      "<input type=hidden name=InvId value=$inv_id>".
      "<input type=hidden name=Desc value='$inv_desc'>".
      "<input type=hidden name=SignatureValue value=$crc>".
      "<input type=hidden name=Shp_item value='$shp_item'>".
      "<input type=hidden name=IncCurrLabel value=$in_curr>".
      "<input type=hidden name=Culture value=$culture>".
      "<input type=submit value='Оплатить'>".
      "</form></html>";
}

function get_status($val)
{
	if ($val == '1') $result = 'Ожидает оплаты';
	if ($val == '2') $result = 'Отправлен';
	if ($val == '3') $result = 'В архиве';
	return $result;
}

function get_sum($val)
{
	$result = 0;
	foreach ($val as $key=>$value)
	{
		$result = $result + $value['subtotal'];
	}
	return $result;	
}

function get_qty($val)
{
	$result = 0;
	foreach ($val as $key=>$value)
	{
		$result = $result + $value['qty'];
	}
	return $result;	
}

function get_currency($val)
{
	foreach ($val as $key=>$value)
	{
		$result = $value['currency'];		
	}
	
	if ($result == 'en') return 'USD';
	if ($result == 'tr') return 'TL';
	if ($result == 'ru') return 'RUB';
	if ($result == NULL) return '';
	
}

?>
<h1 class='lined'><span><?=$lang_title?></span></h1>
<h2><?=$lang_h2?></h2>
<table border=1px>
	<tr>
		<td>№ заказа</td>
		
		<td>Содержимое</td>
		<td>Дата заказа</td>
		<td>Статус</td>
		<td>Количество</td>
		<td>Сумма</td>
		<td>Оплата</td>
	</tr>
<?php foreach ($user_orders as $value) {
	$cart = unserialize($value['cart']);
	?>
	<tr>
	<td><?=$value['id']?></td>
	<td><?php
	foreach ($cart as $item)
	{
		$link_img = base_url().'assets/img/products/thumbs/'.$item['image'];
		$link_product = base_url().$this->uri->segment(1).'/catalog/'.$item['category_alias'].'/'.$item['subcategory_alias'].'/'.$item['id'];
		echo "<a href='$link_product'><img class='preview_img' src='".$link_img."'></a>";
	}
	?></td>
	<td><?=date('d.m.Y <br> H:i', $value['date_order_create']);  ?></td>
	<td><?=get_status($value['status']);?></td>
	<td><?php echo get_qty($cart);?></td>
	<td><?php echo get_sum($cart).' '.get_currency($cart);?></td>
	<td><?php
	if ($value['status'] == 1) {//echo "<a href='".base_url()."template/pay/robokassa/demo2.php'>Оплатить</a>";	
	echo pay($value['id'],get_sum($cart));
	}
	
	?></td>
	</tr>
<?php }?>
</table>
<style>
	.preview_img{
		width: 40px;
	}
	
	table{
	background: #F8F8F8;
    color: #666;
    font-size: 12px;
    margin: 0 auto;
    border-collapse: collapse;
    border-spacing: 0;
    line-height: 1;
    position: relative;
    width: 100%;
	}
	
	table td{
		border: 0px solid gray;
	}
	
	table tr{
		border: 1px solid blue;
	}
	
	table tr:hover {
	}
	
	table tr {
    border: 1px solid #999;
	}
	
	table td, table th {
    padding: 10px;
	}​
</style>
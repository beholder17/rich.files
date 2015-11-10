<?php
//$route['news/:any'] = "content/index/([a-z]+)/([a-z]+)";
$link = mysql_connect("richworld.mysql", "richworld_mysql", "pjyyrnhk") or die("Не могу подключиться");
mysql_select_db("richworld_ci", $link) or die ('Не могу выбрать БД');
mysql_query("SET NAMES utf8");
/* pages - 'main' module routes*/
$query = "SELECT * FROM pages WHERE `show`='1'";
$result=mysql_query($query);
while($r=mysql_fetch_array($result))
{
	//$route['$r[8]] = "main/index/:any";
	$route['ru/'.$r[12]] = "main/index/:any";
	$route['en/'.$r[12]] = "main/index/:any";
	//$route['tr/'.$r[12]] = "main/index/:any";
}

/* Страница - на основе стартового контроллера */
//http://rich_t.ru/index.php/main/index/kh
//$route[':any'] = "main/index/$1";
$route['en/forbidden'] = "main/forbidden";
$route['ru/forbidden'] = "main/forbidden";
$route['tr/forbidden'] = "main/forbidden";




mysql_close($link);
?>
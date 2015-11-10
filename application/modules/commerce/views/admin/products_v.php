<div class='content_page'>
<h1>Товары</h1>
<table class="table table-condensed table-hover table-striped table-bordered">
<thead>
	<th>Изображение</th>
	<th>Название</th>
	<th>Категория</th>
	<th>Подкатегория</th>
	<th>Опции</th>
</thead>
	<?php foreach ($data as $value){ ?>
	<tr>	
		<td><img class='preview' src='<?= $value['image'] ?>'></td>
		<td><?= $value['name'] ?></td>
		<td><?= $value['category'] ?></td>
		<td><?= $value['subcategory'] ?></td>
		<td>3</td>	
	</tr>
	<?php }?>
</table>
<?php
//print_r($data);
?>
</div>
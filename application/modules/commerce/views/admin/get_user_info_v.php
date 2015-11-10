<p><?= $user[0]['name']?> <?= $user[0]['famil']?></p>
<p><?= $user[0]['phone']?></p>
<p><?= $user[0]['email']?></p>
<p><?= $user[0]['adress']?></p>
<p>Зарегистрирован: <?= date('d.m.y H:i',$user[0]['date_registration'])?></p>
<p>Заказов сделано: <?=count($orders)?></p>

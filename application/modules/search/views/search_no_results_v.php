<h1>
<?php 
if ($this->uri->segment(1)=='ru') echo 'Ничего не найдено';
if ($this->uri->segment(1)=='en') echo 'Nothing Found';
if ($this->uri->segment(1)=='tr') echo 'Hiçbirşey Bulunamadı';
?>
</h1>

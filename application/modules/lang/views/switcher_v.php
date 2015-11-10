<div class='lang_switcher'>
			<?php if ($this->uri->segment(1)=='ru') echo "<p>ЯЗЫК</p>";?>
			<?php if ($this->uri->segment(1)=='en') echo "<p>LANG</p>";?>
			<?php if ($this->uri->segment(1)=='tr') echo "<p>DIL</p>";?>
			
			<a id='ru' href='<?=base_url()?>ru<?= $link ?>'></a>
			<a id='en' href='<?=base_url()?>en<?= $link ?>'></a>
			<!--<a id='tr' href='<?=base_url()?>tr<?= $link ?>'></a>-->
			
</div>
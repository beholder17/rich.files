<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts_m extends CI_Model {
public $contacts_msg_rules = array(
			array(
				'field' => 'name',
				'label' => 'Имя',
				'rules' => 'required|xss_clean|trim|cyr'
			),			
			array(
				'field' => 'email',
				'label' => 'E-mail',
				'rules' => 'required|xss_clean|valid_email|trim'
			),
			array(
				'field' => 'theme',
				'label' => 'E-mail',
				'rules' => 'required|xss_clean|valid_email|trim'
			),
			array(
				'field' => 'msg',
				'label' => 'E-mail',
				'rules' => 'required|xss_clean|valid_email|trim'
			)
	);
	
}

/*
<p><label for='name'><?= $this->lang->line('contacts_form_name');?></label><input type='text' name='name' id='' placeholder='Ваше имя'></p>
	<p><label for='email'><?= $this->lang->line('contacts_form_phone_mail');?></label><input type='text' name='email' id='' placeholder='Ваши контакты, чтобы мы могли ответить Вам'></p>
	<p><label for='theme'><?= $this->lang->line('contacts_form_theme');?></label><input type='text' name='theme' id='' placeholder='Тема сообщения'></p>
	<p><label for='msg'><?= $this->lang->line('contacts_form_text');?></label><textarea name='msg'></textarea></p>
	<p><input class='btn_v2'type='submit' name='submit_contacts' id='' placeholder='placeholdr' value='<?= $this->lang->line('contacts_form_submit');?>'></p>
	<p><input type="checkbox" checked="checked" /><span style='position: relative; left: -116px;'><?= $this->lang->line('contacts_form_send_copy');?></span></p>
	<p><label for='captcha'><?= $this->lang->line('contacts_form_captcha');?></label><input type='text' name='captcha' id='' placeholder='Введите код с картинки'></p>
	<p style='position: relative; left: 31%; '><?php echo $image;?></p>*/
	
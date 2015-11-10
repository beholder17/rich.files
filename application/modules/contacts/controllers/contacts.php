<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends MX_Controller {

	public function index()
	{
		$this->load->library('form_validation');
		
		// Получаем меню для сайдбара   
		$this->load->model('commerce/commerce_m');
		$data['subcategory'] = $this->commerce_m->get_all_subcategories();
		$data['category'] = $this->commerce_m->get_all_categories();
		
		/* Блок авторизации */
		$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
		$this->load->helper('captcha');
		$string_for_captcha = random_string('numeric',6);
		
		$vals = array(
			'word'	=> $string_for_captcha,
			'img_path'	=> './img/captcha/',
			'img_url'	=> base_url().'img/captcha/',
			'font_path'	=> './system/fonts/texb.ttf',
			'img_width'	=> '150',
			'img_height' => '50',
			'expiration' => '50'
			);
		$cap = create_captcha($vals);
		$cap['random_string_for_captcha'] = $string_for_captcha;
		$cookie = array(
                    'name'   => 'captcha',
                    'value' => $string_for_captcha,
                    'expire' => '7200'                   
		);
		set_cookie($cookie);	
		
		
		if ($this->input->post('submit_contacts')){
			/*$name = $this->input->post('name');
			$email = $this->input->post('email');
			$theme = $this->input->post('theme');			
			$msg = "Имя: ".$name."<br>Тема сообщения: ".$theme."<br>Контакты: ".$email."<br>";
			$msg .= $this->input->post('msg');
			$captcha = $this->input->post('captcha');
			$config = $this->load->config('config',true);
			$this->load->library('email');
			$config['charset'] = 'utf-8';
			$config['mailtype'] = 'html';
			$this->email->from($config['source_email'], $config['source_name']);
			$this->email->to($config['manager_email']);
			$this->email->subject('RICHWORLD-ST.RU : Обратная связь');
			$this->email->message($msg);
			redirect(base_url().$this->uri->segment(1).'/contacts/successfully_sent');*/
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Имя', 'required');
			$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
			$this->form_validation->set_rules('theme', 'Тема сообщения', 'required');
			$this->form_validation->set_rules('msg', 'Текст сообщения', 'required');
			$this->form_validation->set_rules('captcha', 'Код с картинки', 'required');
			
			
			
			

			
			
			
			
			if ($this->form_validation->run() == FALSE)
			{
				//$this->load->view('myform');
				echo 'error';
			}
			else
			{
				//$this->load->view('formsuccess');
				if ($this->input->post('captcha')==$this->input->post('captcha_hidden')){
					$name = $this->input->post('name');
					$email = $this->input->post('email');
					$theme = $this->input->post('theme');			
					$msg = "Имя: ".$name."<br>Тема сообщения: ".$theme."<br>Контакты: ".$email."<br>";
					$msg .= $this->input->post('msg');
					$captcha = $this->input->post('captcha');
					$config = $this->load->config('config',true);
					$this->load->library('email');
					$config['charset'] = 'utf-8';
					$config['mailtype'] = 'html';
					$this->email->from($config['source_email'], $config['source_name']);
					$this->email->to($config['manager_email']);
					$this->email->subject('RICHWORLD-ST.RU : Обратная связь');
					$this->email->message($msg);
					redirect(base_url().$this->uri->segment(1).'/contacts/successfully_sent');
				} else {
					/* Метатэги */
					/*$data['seo_title'] = 'Контакты';
					$data['seo_description'] = 'Обратная связь, интернет-магазин richworld-st.ru';
					$data['seo_keywords'] = 'Контакты rich world, обратная связь, написать в интернет-магазин, задать вопрос, где находится rich world';
					$data['seo_index'] = 0;
					$data['content'] = 'Код с картинки введен не правильно';
					$this->load->view('main/index_v',$data);*/
					//exit;
					}
			}
		}
		
		
		$data['contacts'] = $this->load->view('contacts/contacts_v.php',$cap,true);
		/* Метатэги */
		$data['seo_title'] = 'Контакты';
		$data['seo_description'] = 'Обратная связь, интернет-магазин richworld-st.ru';
		$data['seo_keywords'] = 'Контакты rich world, обратная связь, написать в интернет-магазин, задать вопрос, где находится rich world';
		
		/* Хлебные крошки */					
		if ($this->uri->segment(1) == 'en') {
			$home = 'Home';
			$contacts = 'Contacts';		
		}
		if ($this->uri->segment(1) == 'ru') {				
			$home = 'Главная';
			$contacts = 'Контакты';		
		
		}
		$this->breadcrumbs->push($home, $this->uri->segment(1));
		$this->breadcrumbs->push($contacts, $this->uri->segment(1).'/contacts');			
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		

		$this->load->view('main/index_v',$data);
	
	}
	
	public function send()
	{
		if ($this->input->post('submit_contacts'))
		{
			/*
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$theme = $this->input->post('theme');			
			$msg = "Имя: ".$name."<br>Тема сообщения: ".$theme."<br>Контакты: ".$email."<br>";
			$msg .= $this->input->post('msg');
			$captcha = $this->input->post('captcha');
			$config = $this->load->config('config',true);
			$this->load->library('email');
			$config['charset'] = 'utf-8';
			$config['mailtype'] = 'html';
			$this->email->from($config['source_email'], $config['source_name']);
			$this->email->to($config['manager_email']);
			$this->email->subject('RICHWORLD-ST.RU : Обратная связь');
			$this->email->message($msg);
			redirect(base_url().$this->uri->segment(1).'/contacts/successfully_sent');
			*/
		}
		else {
			redirect('404');
		}
		
	}
	
	public function successfully_sent()
	{
		// Получаем меню для сайдбара   
		$this->load->model('commerce/commerce_m');
		$data['subcategory'] = $this->commerce_m->get_all_subcategories();
		$data['category'] = $this->commerce_m->get_all_categories();
		
		
		/* Метатэги */
		$data['seo_title'] = 'Контакты';
		$data['seo_description'] = 'Обратная связь, интернет-магазин richworld-st.ru';
		$data['seo_keywords'] = 'Контакты rich world, обратная связь, написать в интернет-магазин, задать вопрос, где находится rich world';
		$data['seo_index'] = 0;
		/* Блок авторизации */
		$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
		
		$data['content'] = $this->load->view('successfully_sent_v','',true);
		$this->load->view('main/index_v',$data);
	}
	function recursive()
	{
		// Получаем меню для сайдбара   
		$this->load->model('commerce/commerce_m');
		$data['subcategory'] = $this->commerce_m->get_all_subcategories();
		$data['category'] = $this->commerce_m->get_all_categories();
		
		
		/* Метатэги */
		$data['seo_title'] = 'Контакты';
		$data['seo_description'] = 'Обратная связь, интернет-магазин richworld-st.ru';
		$data['seo_keywords'] = 'Контакты rich world, обратная связь, написать в интернет-магазин, задать вопрос, где находится rich world';
		$data['seo_index'] = 0;
		/* Блок авторизации */
		$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
		
		
		
		//$data['content'] = ;
		$this->load->view('main/index_v',$data);
	}
	
	function  build_tree($cats,$parent_id){
	  if(is_array($cats) and  count($cats[$parent_id])>0){
		$tree = '<ul>';
		foreach($cats[$parent_id] as $cat){
		   $tree .= '<li>'.$cat['name'];
		   $tree .=  build_tree($cats,$cat['id']);
		   $tree .= '</li>';         
		}
		$tree .= '</ul>';
	  } 
	  else return null;          
	  return $tree;        
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
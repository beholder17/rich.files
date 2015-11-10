<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MX_Controller {

	public function index()
	{
		$this->load->helper('security');
		if (isset($_POST['search_btn'])) {
				$len = mb_strlen($_POST['search_text']);
				
				if (isset($_POST['search_text']) AND $len>2) {$search_text = encode_php_tags($this->input->post('search_text', TRUE));
				$this->load->model('search_m');
				$search_text = mysql_real_escape_string($search_text);
				$count = $this->search_m->search_text($search_text);
				$data['search_text'] = $search_text;
				if ($count['count']!=0){
				//echo "<script>alert('".$count['count']."')</script>";
				/* pager */
				$this->load->library('pager');				
				$tmp = $this->input->get('page');
				if ($tmp!='') $current_page_value = $this->input->get('page'); else $current_page_value = 1;
				$config['base_url'] = base_url()."search";
				$config['total_rows'] = $count['count'];
				$config['per_page'] = 10;
				$config['current_page'] = $current_page_value;
				
				$this->pager->initializer($config); 				

				$data['pager'] = $this->pager->create_links();
				
				
				$data['result'] = $search_result = $this->search_m->search_text($search_text,$config['per_page'],$this->pager->requested_page());
				
				//$data['content'] = $this->commerce_m->get_catalog($category,$subcategory,$config['per_page'],$this->pager->requested_page());
				
				
				
				
				
				
				
				
				if ($search_text!=NULL) $data['content'] = $this->load->view('search/search_v.php',$data,true); else $data['content'] = $this->load->view('search/search_notext_v.php',$data,true);
				
				
				
				
				
				} else  $data['content'] = $this->load->view('search/search_no_results_v',$data,true);
				
				
				
				
				
				
				
				
				
				} else {$search_text=NULL;
				echo "<script>alert('Поисковая строка не может быть короче трех символов')</script>";
				echo "<script>window.history.back()</script>";
				
				}
				
		} else $data['content'] = $this->load->view('search/search_notext_v','',true);
		
		// Получаем меню для сайдбара   
		$this->load->model('commerce/commerce_m');
		$data['subcategory'] = $this->commerce_m->get_all_subcategories();
		$data['category'] = $this->commerce_m->get_all_categories();
				
		/* Блок авторизации */
		$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
		
		/* Метатэги */
		$data['seo_title'] = 'Поиск по сайту';
		$data['seo_description'] = 'Поиск по сайту';
		$data['seo_keywords'] = 'Поиск по сайту';
		

		$this->load->view('main/index_v',$data);
	
	}
	
	public function search()
	{
		/*$this->load->library('email');
		$this->email->from('yv001@yandex.ru', 'YourName');
		$this->email->to('yv001@yandex.ru'); 
		$this->email->subject('Тест Email');
		$this->email->message('Тестирование класса отправки сообщений');	
		$this->email->send();
		echo $this->email->print_debugger();*/
		//echo 'search';
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
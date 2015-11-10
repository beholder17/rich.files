<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends MX_Controller {

	public function index($category=null,$alias=null)
	{	
		$this->lang->load('breadcrumbs',$this->uri->segment(1));			
		
		// Получаем меню для сайдбара   
		$this->load->model('commerce/commerce_m');
		$data['subcategory'] = $this->commerce_m->get_all_subcategories();
		$data['category'] = $this->commerce_m->get_all_categories();
		
		$this->load->model('content/content_m');
		$lang = $this->uri->segment(1);
		$tmp = $this->uri->segment(2);
		$tmp2 = $this->uri->segment(3);
		//обезвредить переменные
		
		if (isset($category) && isset($alias)){
			//echo $tmp.' - '.$tmp2;
			$data['content'] = $this->content_m->get_content($tmp,$tmp2);
			/* Метатэги */
			if ($this->uri->segment(1)=='en'){
			$data['seo_title'] = $data['content'][0]['title_tr'];
			$data['seo_description'] = $data['content'][0]['description_tr'];
			$data['seo_keywords'] = $data['content'][0]['keywords_tr'];}
			
			/*if ($this->uri->segment(1)=='tr'){
			$data['seo_title'] = $data['content'][0]['title_tr'];
			$data['seo_description'] = $data['content'][0]['description_tr'];
			$data['seo_keywords'] = $data['content'][0]['keywords_tr'];
			}*/
			
			if ($this->uri->segment(1)=='ru'){
			$data['seo_title'] = $data['content'][0]['title'];
			$data['seo_description'] = $data['content'][0]['description'];
			$data['seo_keywords'] = $data['content'][0]['keywords'];
			}
			
			/* Хлебные крошки */			
			$data['category_info'] = $this->content_m->get_category_by_alias($tmp);
			if ($this->uri->segment(1) == 'en') {
				$category_name = $data['category_info'][0]['name_tr'];
				$content_name = $data['content'][0]['title_tr'];
			}
			if ($this->uri->segment(1) == 'ru') {
				$category_name = $data['category_info'][0]['name'];
				$content_name = $data['content'][0]['title'];
			}
			$this->breadcrumbs->push('<i class="fa fa-home"></i> '.$this->lang->line('main'), $this->uri->segment(1));
			$this->breadcrumbs->push($category_name, $this->uri->segment(1).'/'.$data['category_info'][0]['category']);
			$this->breadcrumbs->push($content_name, $this->uri->segment(1).'/'.$data['category_info'][0]['category'].'/'.$data['content'][0]['alias']);
			$data['breadcrumbs'] = $this->breadcrumbs->show();
			
			
			$data['content'] = $this->load->view('content/content_view_v',$data,true);
			
			/* Блок авторизации */
			$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
			$this->load->view('main/index_v',$data);
		}
		
		if (isset($category) && !isset($alias)){
		
		
		/* pager */
		$this->load->library('pager');				
		$current_page_check = $this->input->get('page');
		if ($current_page_check!='') { $current_page_value = $this->input->get('page');} else { $current_page_value = 1; }
		$config['base_url'] = base_url().$lang.'/'.$tmp;
		$config['total_rows'] = $this->content_m->get_material_count($tmp);
		$config['per_page'] = "10";
		$config['current_page'] = $current_page_value;				
		$this->pager->initializer($config); 				
		$data['pager'] = $this->pager->create_links();		
		$data['category'] = $tmp;


		


		//$data['pagination'] = '';
		//echo "<script>alert('Переходим на страницу категории контента (если она есть!!!!)');</script>";	
		$data['category_info'] = $this->content_m->get_category_by_alias($tmp);
		$data['content'] = $this->content_m->get_category_list($tmp,$config['per_page'],$this->pager->requested_page());
		
		//var_dump($data['category_info']);
		/* Метатэги */
		$data['seo_title'] = $data['category_info'][0]['name'];
		$data['seo_description'] = 'Страницы контента';
		$data['seo_keywords'] = 'Страницы контента';
		
		/* Хлебные крошки */		
		if ($this->uri->segment(1) == 'en') $category_name = $data['category_info'][0]['name_tr'];
		if ($this->uri->segment(1) == 'ru') $category_name = $data['category_info'][0]['name'];		
		$this->breadcrumbs->push('<i class="fa fa-home"></i> '.$this->lang->line('main'), $this->uri->segment(1));
		$this->breadcrumbs->push($category_name, "##");					
		$data['breadcrumbs'] = $this->breadcrumbs->show();
		
		
		$data['content'] = $this->load->view('content/category_list_v',$data,true);
		/* Блок авторизации */
		$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
		$this->load->view('main/index_v',$data);
		
		
		
		
		
		
		
		
		
		
		}
		if (!isset($category) && isset($alias)){
		echo "<script>alert('3214567895557');</script>";	
		$this->load->view('main/index_v',$data);
		}
		if (!isset($category) && !isset($alias)){
		echo "<script>alert('31218764');</script>";	
		$this->load->view('main/index_v',$data);
		}
		
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
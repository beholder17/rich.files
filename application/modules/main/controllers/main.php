<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MX_Controller {

	public function __construct()
       {
            parent::__construct();
			
       }
	
	 
	public function index($page_alias=null)
	{
			$this->output->set_header("HTTP/1.0 200 OK");
$this->output->set_header("HTTP/1.1 200 OK");
$this->output->set_header('Last-Modified: Mon, 02 Oct 2015 15:45:41 GMT');
$this->output->set_header("Cache-Control: max-age=3600, must-revalidate");
		//$this->output->set_header('Last-Modified: '.gmdate('D, d M Y H:i:s', $last_update).' GMT');
		//$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		//$this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
		//$this->output->set_header("Pragma: no-cache");
		/*
		function index()
{
 
    // создаём вывод
    $output  = $this->load->view('header',NULL,TRUE);
    $output .= $this->load->view('main',NULL,TRUE);
    $output  .= $this->load->view('footer',NULL,TRUE);
    //устанавливаем вывод
    $this->output->set_output($output);
}
 
function _output()
{
    //достаём вывод
    $sting = $this->output->get_output();
 
    //
    // что-нибудь делаем с выводом
    //
 
    // выводим вывод на экран
    echo $string;
}
		*/
		//$this->output->cache(20);
		// Хлебные крошки
		$this->lang->load('breadcrumbs', $this->uri->segment(1));
		$this->breadcrumbs->push('<i class="fa fa-home"></i> '.$this->lang->line('main'), $this->uri->segment(1));
		

		// Получаем меню для сайдбара   
		$this->load->model('commerce/commerce_m');
		$data['subcategory'] = $this->commerce_m->get_all_subcategories();
		$data['category'] = $this->commerce_m->get_all_categories();
		
		if (!isset($page_alias)) {
		//error_reporting(0);
		/* Получаем слайдер */
		//$data['slider'] = $this->load->view('main_slider_v','',true);
		
		
		// Получаем блок последних новостей
		$this->load->model('content/content_m');
		$block_data['category_content'] = 'news';
		$block_data['news'] = $this->content_m->get_content_block('news',3);
		$data['block_news'] = $this->load->view('block_news_v',$block_data,true);
		
		/* Метатэги */
		$data['seo_title'] = "Rich World Professional - инструменты для ногтей, ресниц, волос";
		$data['seo_description'] = "Интернет-магазин, в котором вы можете приобрести инструменты для ногтей, ресниц, волос оптом и в розницу";
		$data['seo_keywords'] = "Интернет-магазин, товары для ногтей, товары для ресниц, купить оптом товары для волос, быстрая доставка";

		/* Блок авторизации */
		$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
		$data['breadcrumbs'] = "";
		} else {
						
			$page_alias = $this->uri->segment(2); //обезвредить			
			$this->load->model('main_m');
			$data['content'] = $this->main_m->get_page($page_alias);
			if ($data['content']== false ) redirect(base_url().'404', 'refresh');
			
			/* Метатэги */
			$data['seo_title'] = $data['content'][0]['title'];
			$data['seo_description'] = $data['content'][0]['description'];
			$data['seo_keywords'] = $data['content'][0]['keywords'];
			
			/* Блок авторизации */
			$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
			
			
			
			/* Хлебные крошки */					
			if ($this->uri->segment(1) == 'en') {
				$page_name = $data['content'][0]['title_tr'];
			}
			if ($this->uri->segment(1) == 'ru') {				
				$page_name = $data['content'][0]['title'];
			}
			$this->breadcrumbs->push('<i class="fa fa-home"></i> '.$this->lang->line('main'), $this->uri->segment(1));
			$this->breadcrumbs->push($page_name, $this->uri->segment(1).'/'.$data['content'][0]['alias']);			
			$data['breadcrumbs'] = $this->breadcrumbs->show();
			$data['content'] = $this->load->view('main/page_v',$data,true);
		}
		
			
		
		//$this->output->set_output($data['content']);
		
			$this->output->get_output($data);
		$this->load->view('index_v',$data);
	}
	
	/* Страница 404 */
	public function notfound()
	{
		$this->load->view('notfound_v');
	}
	
	public function forbidden()
	{
		$this->load->view('forbidden_v');
	}
	

	

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
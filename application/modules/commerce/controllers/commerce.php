<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commerce extends MX_Controller {
	public function __construct()
       {
            parent::__construct();
		//	$this->load->library('cart');
			
       }
	public function catalog()
	{//$this->output->cache(1);
		// Получаем меню для сайдбара   
		$this->load->model('commerce/commerce_m');
		$data['subcategory'] = $this->commerce_m->get_all_subcategories();
		$data['category'] = $this->commerce_m->get_all_categories();
			
		
		$this->load->library('pagination');
		$this->load->model('commerce_m');
		$lang = $this->uri->segment(1);
		$category = $this->uri->segment(3);
		$subcategory = $this->uri->segment(4);		
		$item_id = $this->uri->segment(5);
		$data['subcategory_alias'] = $subcategory;
		$data['category_info'] = $this->commerce_m->get_category($category);
		$data['subcategory_info'] = $this->commerce_m->get_subcategory($subcategory);
		//print_r ($data['category_info']);
		if ($category!=null AND $subcategory==null){
				if ($this->uri->segment(1)=='en') {
					$data['seo_title'] = $data['category_info'][0]['name'].' production catalog';
					$data['seo_description'] = $data['category_info'][0]['description_tr'];
					$data['seo_keywords'] = "buy shops for nail, hair, low price, fast delivery";
				}
				if ($this->uri->segment(1)=='ru') {
					$data['seo_title'] = 'Каталог продукции '.$data['category_info'][0]['name'];
					$data['seo_description'] = $data['category_info'][0]['description'];
					$data['seo_keywords'] = "купить, для ногтей, ".$data['category_info'][0]['name'].", купить лаки ".$data['category_info'][0]['name']."оптом и в розницу, купить пилки для ногтей, гель для наращивания";
				}
				
				$data['content'] = $this->load->view('catalog_page_category_v',$data,true);
				/* Блок авторизации */
				$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
				/* Хлебные крошки */					
				if ($this->uri->segment(1) == 'en') {
					$lang_home = 'Home';
					$lang_catalog = 'Catalog';				
				}
				if ($this->uri->segment(1) == 'ru') {				
					$lang_home = 'Главная';
					$lang_catalog = 'Каталог';				
				}
				$this->breadcrumbs->push('<i class="fa fa-home"></i> '.$lang_home, $this->uri->segment(1));
				$this->breadcrumbs->push($lang_catalog, $this->uri->segment(1).'/catalog');
				$this->breadcrumbs->push($data['category_info'][0]['name'], $this->uri->segment(1).'/catalog/'.$data['category_info'][0]['alias']);
				//$this->breadcrumbs->push($lang_subcategory, $this->uri->segment(1).'/commerce'.'/ew32r');
				$data['breadcrumbs'] = $this->breadcrumbs->show();
				
				
				
				$this->load->view('main/index_v',$data);
				}
		if ($category!=null AND $subcategory!=null AND $item_id==null){
				/* check to existing product at category/subcategory */
				if ($this->commerce_m->product_existing($category,$subcategory) == false) { 
				//TODO:проверка наличия дочерних категорий. если нет - то редирект
				//redirect(base_url().$this->uri->segment(1).'/commerce/no_products');		
			
				} else {
				
				/* pager */
				$this->load->library('pager');				
				$tmp = $this->input->get('page');
				
				if ($tmp!='') $current_page_value = $this->input->get('page'); else $current_page_value = 1;
				$config['base_url'] = base_url().$this->uri->segment(1)."/catalog/$category/$subcategory";
				
				$config['total_rows'] = $this->commerce_m->get_products_count($category,$subcategory);
				
				$config['per_page'] = 24;
				$config['current_page'] = $current_page_value;				
				$this->pager->initializer($config); 								
				$data['pager'] = $this->pager->create_links();	
				$data['content'] = $this->commerce_m->get_catalog($category,$subcategory,$config['per_page'],$this->pager->requested_page());				
				}
				$parent = $this->commerce_m->subcategory_is_parent($data['subcategory_info'][0]['id']);
				
				
				$his_parent_tmp = $this->commerce_m->get_subcategory_by_parent($data['subcategory_info'][0]['parent']);		
				
				$data['his_children'] = $this->commerce_m->get_child_subcategory($data['subcategory_info'][0]['id']);
				//var_dump($his_children);
				
				if (count($his_parent_tmp)!=0) {
				$data['his_parent'] = $data['subcategory_info'][0]['parent'];
				$data['his_parent_alias'] = $his_parent_tmp[0]['alias'];	
				}
				
				//var_dump ($data['subcategory_info'][0]['parent']);
				
				if ($parent==true) {
					//echo 'parent';
					$data['childs'] = $this->commerce_m->get_child_subcategory($data['subcategory_info'][0]['id']);
					
					
				
				}
				
				
				//$data['content'] = $this->commerce_m->get_catalog($category,$subcategory,$config['per_page'],$this->pager->requested_page());
				
				$data['cart'] = $this->cart->contents();				
				/* Метатэги. Получаем из категории/подкатегории */
				/*$data['seo_title'] = $data['content'][0]['seo_title'];
				$data['seo_description'] = $data['content'][0]['seo_description'];
				$data['seo_keywords'] = $data['content'][0]['seo_keywords'];*/
				//var_dump($data['category_info']);
				if ($this->uri->segment(1)=='en') {
					$data['seo_title'] = $data['subcategory_info'][0]['name_tr'].' by '.$data['category_info'][0]['name'];
					$data['seo_description'] = $data['subcategory_info'][0]['description_tr'];
					$data['seo_keywords'] = "buy shops for nail, hair, low price, fast delivery";
				}
				if ($this->uri->segment(1)=='ru') {
					$data['seo_title'] = $data['subcategory_info'][0]['name'].' от '.$data['category_info'][0]['name'];
					$data['seo_description'] = $data['subcategory_info'][0]['description'];
					$data['seo_keywords'] = "купить ". $data['subcategory_info'][0]['name']." не дорого, качественные товары для ноготей, купить лаки для ногтей";
				}
				
				$data['content'] = $this->load->view('catalog_v',$data,true);
				/* Блок авторизации */
				$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
				/* Хлебные крошки */					
				if ($this->uri->segment(1) == 'en') {
					$lang_home = 'Home';
					$lang_catalog = 'Catalog';
					$lang_subcategory = $data['subcategory_info'][0]['name_tr'];
				}
				if ($this->uri->segment(1) == 'ru') {				
					$lang_home = 'Главная';
					$lang_catalog = 'Каталог';
					$lang_subcategory = $data['subcategory_info'][0]['name'];
				}
				$this->breadcrumbs->push('<i class="fa fa-home"></i> '.$lang_home, $this->uri->segment(1));
				$this->breadcrumbs->push($lang_catalog, $this->uri->segment(1).'/catalog');
				$this->breadcrumbs->push($data['category_info'][0]['name'], $this->uri->segment(1).'/catalog/'.$data['category_info'][0]['alias']);
				$this->breadcrumbs->push($lang_subcategory, $this->uri->segment(1).'/commerce'.'/ew32r');
				$data['breadcrumbs'] = $this->breadcrumbs->show();
				
				
				
				$this->load->view('main/index_v',$data);
				
		}
		
		if ($category!=null AND $subcategory!=null AND $item_id!=null){
				/* check to existing product at category/subcategory */
				if ($this->commerce_m->product_item_existing($category,$subcategory,$item_id) == false) { redirect(base_url().$this->uri->segment(1).'/commerce/no_product_item');				
				}
				
				
				
				$data['item'] = $this->commerce_m->get_product($item_id);
				
				
				//$data['content'] = $this->commerce_m->get_catalog($category,$subcategory,$config['per_page'],$this->pager->requested_page());
				//$data['content'] = 'dslfkj - '.$item_id;
				$data['cart'] = $this->cart->contents();
				/* Метатэги */
				//var_dump ($data['item']);
				/*$data['seo_title'] = $data['item'][0]['seo_title'];
				$data['seo_description'] = $data['item'][0]['seo_description'];
				$data['seo_keywords'] = $data['item'][0]['seo_keywords'];*/
				$data['seo_title'] = $data['item'][0]['name'].' - '.$data['item'][0]['category'];
				$data['seo_description'] = $data['item'][0]['seo_description'];
				$data['seo_keywords'] = $data['item'][0]['seo_keywords'];
				
				$data['content'] = $this->load->view('product_v',$data,true);
				/* Блок авторизации */
				$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
				/* Хлебные крошки */					
				if ($this->uri->segment(1) == 'en') {
					$lang_home = 'Home';
					$lang_catalog = 'Catalog';
					$lang_subcategory = $data['subcategory_info'][0]['name_tr'];
					$lang_item = $data['item'][0]['name_tr'];
				}
				if ($this->uri->segment(1) == 'ru') {				
					$lang_home = 'Главная';
					$lang_catalog = 'Каталог';
					$lang_subcategory = $data['subcategory_info'][0]['name'];
					$lang_item = $data['item'][0]['name'];
				}
				$this->breadcrumbs->push('<i class="fa fa-home"></i> '.$lang_home, $this->uri->segment(1));
				$this->breadcrumbs->push($lang_catalog, $this->uri->segment(1).'/catalog');
				$this->breadcrumbs->push($data['category_info'][0]['name'], $this->uri->segment(1).'/catalog/'.$data['category_info'][0]['alias']);
				$this->breadcrumbs->push($lang_subcategory, $this->uri->segment(1).'/catalog/'.$data['category_info'][0]['alias'].'/'.$data['subcategory_info'][0]['alias']);
				$this->breadcrumbs->push($lang_item, $this->uri->segment(1).'/commerce'.'/ew3wewwe2r');
				$data['breadcrumbs'] = $this->breadcrumbs->show();
				
				
				$this->load->view('main/index_v',$data);
				
		}
		
		if ($category==null AND $subcategory==null){
					if ($this->uri->segment(1)=='en') {
					$data['seo_title'] = "Rich World Professional Catalog - richworld-st.ru";
					$data['seo_description'] = "Product quality products for nails, hair, eyelashes richworld-st.ru";
					$data['seo_keywords'] = "buy wholesale, gels, liquids for nails, for hair, catalog rich world";
				}
				if ($this->uri->segment(1)=='ru') {
					$data['seo_title'] = "Каталог продукции интернет-магазина richworld-st.ru";
					$data['seo_description'] = "Каталог качественной продукции для ногтей, волос, ресниц richworld-st.ru";
					$data['seo_keywords'] = "каталог rich world, купить лаки для ногтей, продукция для ресниц не дорого, интернет-магазин продукции для ногтей, ресниц, волос";
				}
				
				$data['content'] = $this->load->view('catalog_mainpage_v',$data,true);
				/* Блок авторизации */
				$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
				/* Хлебные крошки */					
				if ($this->uri->segment(1) == 'en') {
					$lang_home = 'Home';
					$lang_catalog = 'Catalog';				
				}
				if ($this->uri->segment(1) == 'ru') {				
					$lang_home = 'Главная';
					$lang_catalog = 'Каталог';				
				}
				$this->breadcrumbs->push('<i class="fa fa-home"></i> '.$lang_home, $this->uri->segment(1));
				$this->breadcrumbs->push($lang_catalog, $this->uri->segment(1).'/catalog');
				//$this->breadcrumbs->push($data['category_info'][0]['name'], $this->uri->segment(1).'/catalog/'.$data['category_info'][0]['alias']);
				//$this->breadcrumbs->push($lang_subcategory, $this->uri->segment(1).'/commerce'.'/ew32r');
				$data['breadcrumbs'] = $this->breadcrumbs->show();
				
				
				
				$this->load->view('main/index_v',$data);
		}
		
		
	}
	
	function add_to_comparsion()
	{
		if (!$this->input->post('id')) {redirect('404');}

		
		$tmp = $this->input->post('id');
		if ($this->session->userdata('comparsion')==NULL) $data = array(); else $data = $this->session->userdata('comparsion');
		
		if (!in_array($tmp, $data)) {

		array_push($data,$tmp);
		
		$comparedata = array(
                   'comparsion'  => $data
               );

		$this->session->set_userdata($comparedata);
		echo "Добавлено в сравнения";
		} else echo "уже в сравнении";
		//echo $tmp;
		
		/*
		$this->cart->update($data);
		redirect (base_url().'commerce/cart');*/
	}
	
	function comparsion_del($id=NULL)
	{
		if ($id==NULL) {redirect('404');}
		$data = $this->session->userdata('comparsion');		
		//print_r ($data)."<br>";
		$key = array_search($id, $data);
		//echo ">>".$key."<<";
		if ($key!==FALSE) {
			unset($data[$key]);			
			$comparedata = array(
                   'comparsion'  => $data
               );
			$this->session->set_userdata($comparedata);
			redirect(base_url().$this->uri->segment(1).'/commerce/comparsion');
		} //else redirect('404'); 
	}
	
	function comparsion()
	{
		// Получаем меню для сайдбара   
		$this->load->model('commerce/commerce_m');
		$data['subcategory'] = $this->commerce_m->get_all_subcategories();
		$data['category'] = $this->commerce_m->get_all_categories();
		
		/* Метатэги */
		$data['seo_title'] = "Сравнение товаров";
		$data['seo_description'] = "Страница сравнения товаров";
		$data['seo_keywords'] = "Корзина товаров";
		
		/* Содержимое корзины */
		$data['cart'] = $this->cart->contents();
		
		/* Сравнение товаров */
		
		$data['comparsion_id_list'] = $this->session->userdata('comparsion');
		
		/* Есть ли товары в списке сравнения */
		$count_item_comparsion = count($data['comparsion_id_list']);
		if ($count_item_comparsion!=0) {
			$this->load->model('commerce_m');
			$data['comparsion_items'] = array();
			foreach ($data['comparsion_id_list'] as $value)
			{
				array_push ($data['comparsion_items'],$this->commerce_m->get_product($value));
			}
			/* Блок авторизации */
			$data['auth_form'] = $this->load->module('auth')->auth_block_generator();

			$data['content'] = $this->load->view('commerce/comparsion_v',$data,true);
			
			
		} else {
			/* Блок авторизации */
			$data['auth_form'] = $this->load->module('auth')->auth_block_generator();

			$data['content'] = $this->load->view('commerce/comparsion_no_items_v',$data,true);
		}
		$this->load->view('main/index_v',$data);
		
		
		
		
	}
	
	function thumb_extractor($img)
	{
		$path_info = pathinfo($img);
		$value = $path_info['filename'].'_thumb.'.$path_info['extension'];
		return $value;
	}
	
	
	
	function no_products()
	{
		// Получаем меню для сайдбара   
		$this->load->model('commerce/commerce_m');
		$data['subcategory'] = $this->commerce_m->get_all_subcategories();
		$data['category'] = $this->commerce_m->get_all_categories();
		
		/* Метатэги */
		$data['seo_title'] = "Товаров пока нет";
		$data['seo_description'] = "Товаров пока нет";
		$data['seo_keywords'] = "Товаров пока нет";
		
		
		
		$data['content'] = $this->load->view('catalog_v',$data,true);
		/* Блок авторизации */
		$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
		
		$data['content'] = $this->load->view('commerce_no_products_v',$data,true);
		$this->load->view('main/index_v',$data);
	}
	
	public function cart($set_currency=NULL)
	{
		// пересчет корзины на одну валюту
		if ($set_currency!=NULL){

			switch ($set_currency) {
			case 'en':
				$cur_suffix='usd';
				break;
			case 'tr':
				$cur_suffix='try';
				break;
			case 'ru':
				$cur_suffix='rub';
				break;
			default: redirect('404');
			}
			
			
			
			
			$cart = $this->cart->contents();
			//echo $set_currency."<br>";
			//var_dump($cart);
			$this->load->model('commerce/commerce_m');
			foreach ($cart as $key=>$value)
			{
				//$this->cart->insert();
				//if ($cart[$key]['currency']!=$set_currency){
					$cart[$key]['currency'] = $set_currency;
					
					//получить цену в нужной валюте
					$new_price = $this->commerce_m->get_product($value['id']);
					
					$price_index = 'price-'.$cur_suffix;
					$new_price = $new_price[0][$price_index];
					
					$cart[$key]['price'] = $new_price;
					$this->cart->insert($cart[$key]);
					//var_dump($cart[$key]);
					
					
				//}
				
			}
			redirect(base_url().$this->uri->segment(1).'/commerce/cart');
			//var_dump($this->cart->contents());
			
		} else {
			// Получаем меню для сайдбара   
			$this->load->model('commerce/commerce_m');
			$data['subcategory'] = $this->commerce_m->get_all_subcategories();
			$data['category'] = $this->commerce_m->get_all_categories();
			
			/* Метатэги */
			$data['seo_title'] = "Корзина товаров";
			$data['seo_description'] = "Корзина товаров";
			$data['seo_keywords'] = "Корзина товаров";
			$data['seo_index'] = "0";
			/* Содержимое корзины */
			$data['cart'] = $this->cart->contents();
			
			/* Блок авторизации */
			$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
			
			
			/* Проверка корзины на мультивалютность */
			//var_dump ($data['cart']);
			$tmp = array();
			foreach ($data['cart'] as $item)
			{
				array_push($tmp,$item['currency']);
			}
			$result = array_unique($tmp);
			//print_r($result);
			$data['multi_currency'] = $result;
			
			
			if ($data['cart']!=null) $data['content'] = $this->load->view('commerce/cart_v',$data,true); else $data['content'] = $this->load->view('commerce/cart_is_empty_v',$data,true);
			$this->load->view('main/index_v',$data);
		}
			
		
		
	}
	
	function add_to_cart()
	{
		if (!$this->input->post('json_data')) {redirect('404');	}
		//session_start();
		$id = $this->input->post('json_data');
		
		
		$this->load->model('commerce_m');
		$product = $this->commerce_m->get_product($id);

		
		$product[0]['image'] = $this->thumb_extractor($product[0]['image']);
		
		/* выбор валюты в зависимости от текущего языка */
		if ($this->uri->segment(1) == 'en') $price = $product[0]['price-usd']; 
		if ($this->uri->segment(1) == 'tr') $price = $product[0]['price-try'];
		if ($this->uri->segment(1) == 'ru') $price = $product[0]['price-rub'];
		
			$data = array(
			array(
               'id'      => $product[0]['id'],
               'qty'     => '1',
               'price'   => $price,
               'name'    => $product[0]['name'],
			   'name_tr'    => $product[0]['name_tr'],
			   'image'    => $product[0]['image'],
			   'currency'    => $this->uri->segment(1),
			   'category_alias'    => $product[0]['category_alias'],
			   'subcategory_alias'    => $product[0]['subcategory_alias'],
			   'sku'    => $product[0]['sku']
            )
			
			);
			
			
		$re = $this->cart->insert($data);
		$this->cart->insert($data);
		//print_r ($data);
		//echo "<br><br><br>";
		//print_r('>>>'.$re.'<<<');
		$data = $this->cart->contents();
		//print_r ($data);
	}
	
	public function cart_drop()
	{
		$this->cart->destroy();
	}
	
	public function cart_remove_item()
	{
		/*$data = array( 
		  array( 
		  'rowid' => 'b99ccdf16028f015540f341130b6d8ec', 
		  'qty' => 3 
		  ), 
		  
		  array( 
		  'rowid' => 'xw82g9q3r495893iajdh473990rikw23', 
		  'qty' => 4 
		  ), 
		  
		  array( 
		  'rowid' => 'fh4kdkkkaoe30njgoe92rkdkkobec333', 
		  'qty' => 2 
		  ) 
		  );
		*/
		if (!$this->input->post('json_data')) {redirect('404');	}
		//session_start();
		
		$tmp = json_decode($this->input->post('json_data'),true);
		
		$data = array(
		  'rowid' => $tmp['rowid'], 
		  'qty' => $tmp['qty']
		  );
		
		$this->cart->update($data);
		redirect (base_url().'commerce/cart');
	}
	
	function cart_calculate()
	{
		if ($this->input->post('cart_calculate'))
		{
			$data = array();
			$iteration = 1;
			$cart_calculate = $this->input->post();
			foreach ($cart_calculate as $key => $value)
			{
				if ($key =='cart_calculate') continue;
				if (!isset($_POST['qty_'.$iteration])) continue;
				$array = array('rowid'=>$_POST['rowid_'.$iteration], 'qty' => $_POST['qty_'.$iteration]);
				$this->cart->update($array);
				$iteration++;
			}
			redirect(base_url().'commerce/cart');
		}
		
	}
	
	function checkout()
	{
		$this->load->library('form_validation');
		// Получаем меню для сайдбара   
		$this->load->model('commerce/commerce_m');
		$data['subcategory'] = $this->commerce_m->get_all_subcategories();
		$data['category'] = $this->commerce_m->get_all_categories();
		
		/* Метатэги */
		$data['seo_title'] = "Оформление заказа";
		$data['seo_description'] = "Оформление заказа";
		$data['seo_keywords'] = "Оформление заказа";
		$data['seo_index'] = "0";
		/* Информация о пользователе */
		$this->load->model('auth/auth_m');
		//$data['user_informer'] = $this->auth_m->get_user_by_id('1');
		
		//echo "<script>alert('".$this->session->userdata('last_activity')."');</script>";
		$data['user_informer'] = $this->auth_m->get_user_by_id($this->session->userdata('id'));
		
		$data['userdata'] =  $this->session->userdata;
		
		//echo '<script>alert("'.time().'");</script>';
		
		/* Содержимое корзины */
		$data['cart'] = $this->cart->contents();
		
		/* Блок авторизации */
		$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
		
		if ($data['cart']!=null) $data['content'] = $this->load->view('commerce/checkout_v',$data,true); else $data['content'] = $this->load->view('commerce/cart_is_empty_v',$data,true);
		$this->load->view('main/index_v',$data);
	}
	
	function checkout_send()
	{

			// Получаем меню для сайдбара   
			$this->load->model('commerce/commerce_m');
			$data['subcategory'] = $this->commerce_m->get_all_subcategories();
			$data['category'] = $this->commerce_m->get_all_categories();
			
			/* Метатэги */
			$data['seo_title'] = "Оформление заказа";
			$data['seo_description'] = "Оформление заказа";
			$data['seo_keywords'] = "Оформление заказа";
			$data['seo_index'] = "0";
		
			/* Блок авторизации */
			$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
			
			/* Информация о пользователе */
			$this->load->model('auth/auth_m');
			$data['user_informer'] = $this->auth_m->get_user_by_id($this->session->userdata('id'));
			
			//echo '<script>alert("'.$this->input->post('comment').'");</script>';
			
			$sql_data['date_order_create'] = time();
			$sql_data['comment'] = $this->input->post('comment');
			$sql_data['user_id'] = $this->session->userdata('id');
			$sql_data['cart'] = serialize($this->cart->contents());
			$sql_data['ip'] = $_SERVER["REMOTE_ADDR"];
			//var_dump($sql_data['cart']);
			$sql_data['status'] = 1;

			
			$this->load->model('commerce_m');
			$this->commerce_m->add_order($sql_data);
			
			
			$data['userdata'] =  $this->session->userdata;
			
			$this->cart->destroy();
			
			$data['content'] = $this->load->view('checkout_done_v.php','',true);
			$this->load->view('main/index_v',$data);
		
	}
	
	function block_recommended_slider($limit=NULL)
	{	
	$this->load->model('commerce/commerce_m');
	$data['items'] = $this->commerce_m->get_recommended_products($limit);
	$this->load->view('block_recommended_slider_v',$data);	
	}
	
	function block_recommended($limit=NULL)
	{
	$this->load->model('commerce/commerce_m');
	$data['cart'] = $this->cart->contents();
	$data['items'] = $this->commerce_m->get_recommended_products($limit);
	$this->load->view('block_recommended_v',$data);	
	}
	
	public function novelty($category=NULL, $subcategory=NULL)
	{
		if($this->uri->segment(1)=='en'){$subcat_index = 'name_tr';}
		if($this->uri->segment(1)=='ru'){$subcat_index = 'name';}
		// Получаем меню для сайдбара   
		$this->load->model('commerce/commerce_m');
		$data['subcategory'] = $this->commerce_m->get_all_subcategories();
		$data['category'] = $this->commerce_m->get_all_categories();
		if($category==NULL AND $subcategory==NULL){
			/* Метатэги */
			$data['seo_title'] = "Novelty";
			$data['seo_description'] = "Novelty";
			$data['seo_keywords'] = "Novelty";
			$data['seo_index'] = "1";
			/* Содержимое корзины */
			//$data['cart'] = $this->cart->contents();
			
			/* Блок авторизации */
			$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
			
			/* Получение новинок */
			/* Выбираем все категории и подкатегории*/
			$data['to_output'] = '';
			//$data['categories'] = $this->commerce_m->get_all_categories_novelty();
			$data['categories'] = $this->commerce_m->get_all_categories();
			foreach($data['categories'] as $cat)
			{
				$cat_exist = $this->commerce_m->product_novelty_existing_cat($cat['id']);
				if ($cat_exist==true){
					$data['to_output'] .= '<h2>'.$cat['name'].'</h2>';
					$tmp['category_id'] = $cat['id'];
					$tmp['category_alias'] = $cat['alias'];
					$data['subcategories'] = $this->commerce_m->get_all_subcategories();
					foreach($data['subcategories'] as $subcat)
					{
						$tmp['subcategory_id'] = $subcat['id'];
						$tmp['subcategory_alias'] = $subcat['alias'];
						$subcat_exist = $this->commerce_m->product_novelty_existing_subcat($cat['id'],$subcat['id']);
						if ($subcat_exist==true){
							$data['to_output'] .= '<h3>'.$subcat[$subcat_index].'</h3>';
							
							$tmp['info'] = $this->commerce_m->get_novelty_short($cat['id'],$subcat['id']);
							$tmp['cart'] = $this->cart->contents();
							//print_r ($tmp);
							/*foreach ($tmp as $value)
							{
								$data['to_output'] .= $value['name'];
							}*/
							if (count($tmp['info'])>0){$data['to_output'] .= $this->load->view('commerce/novelty_catalog_element_v',$tmp,true);}
						}
					}
				}
			}
			
			
			//$data['novelties'] = $this->commerce_m->get_novelty_short(1,3);
			
			
			$data['content'] = $this->load->view('commerce/novelty_v',$data,true);
			$this->load->view('main/index_v',$data);
		}
		if($category!=NULL AND $subcategory!=NULL){
			$category = mysql_real_escape_string($category);
			$subcategory = mysql_real_escape_string($subcategory);
				
				/* Метатэги */
			$data['seo_title'] = "Novelty";
			$data['seo_description'] = "Novelty";
			$data['seo_keywords'] = "Novelty";
			$data['seo_index'] = "1";
			/* Содержимое корзины */
			//$data['cart'] = $this->cart->contents();
			
			/* Блок авторизации */
			$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
			
			/* Получение новинок */
			/* Выбираем все категории*/
			$data['category'] = $this->commerce_m->get_category_by_id($category);
			$data['subcategory'] = $this->commerce_m->get_subcategory_by_id($subcategory);
			$data['novelties'] = $this->commerce_m->get_novelty_full($category,$subcategory);
			
			$tmp = $this->commerce_m->get_category_by_id($category);			
			$data['category_alias'] = $tmp['0']['alias'];
			$tmp = $this->commerce_m->get_subcategory_by_id($subcategory);
			$data['subcategory_alias'] = $tmp['0']['alias'];
			$data['cart'] = $this->cart->contents();
			$data['category_id'] = $category;
			$data['subcategory_id'] = $subcategory;
			
			
			$data['content'] = $this->load->view('commerce/novelty_cat_subcat_v',$data,true);
			$this->load->view('main/index_v',$data);
		}
		if($category!=NULL AND $subcategory==NULL){redirect('404');}
	}
	
	
	
	function orders()
	{
		$this->load->model('commerce/commerce_admin_m');
		$tmp['data'] = $this->commerce_admin_m->get_orders();
		return $data['content'] = $this->load->view('commerce/admin/orders_show_v',$tmp);
	}
	
	function print_order($id)
	{
		$id = mysql_real_escape_string($id);
		$this->load->model('commerce/commerce_admin_m');
		$this->load->model('auth/auth_m');
		$tmp['data'] = $this->commerce_admin_m->get_order_details($id);		
		$tmp['user'] = $this->auth_m->get_user_by_id($tmp['data'][0]['user_id']);
		return $data['content'] = $this->load->view('commerce/admin/print_order_v',$tmp);
	}
	
	function adm_orders($param=null)
	{
		$param = mysql_real_escape_string($param);
		$this->load->model('commerce/commerce_admin_m');
		switch($param){
			case "history":
			$param = '3';
			$data['data'] = $this->commerce_admin_m->get_orders_by_status($param);
			$this->load->view('commerce/admin/orders_show_v',$data);
			break;
			case "paid":
			$param = '2';
			$data['data'] = $this->commerce_admin_m->get_orders_by_status($param);
			$this->load->view('commerce/admin/orders_show_v',$data);
			break;
			case "unpaid":
			$param = '1';
			$data['data'] = $this->commerce_admin_m->get_orders_by_status($param);
			$this->load->view('commerce/admin/orders_show_v',$data);
			break;
			default: redirect('404');
		}
		
		if ($param == 'unpublish') {$data['data'] = $this->reviews_m->get_all_unpublish_reviews();}
		if ($param == 'publish') {$data['data'] = $this->reviews_m->get_all_reviews();}
		if ($param == null) {$data['data'] = $this->reviews_m->get_all_reviews();}
	}
	
	function promo($category=NULL, $subcategory=NULL)
	{
		
		if($this->uri->segment(1)=='en'){$subcat_index = 'name_tr';}
		if($this->uri->segment(1)=='ru'){$subcat_index = 'name';}
		// Получаем меню для сайдбара   
		$this->load->model('commerce/commerce_m');
		$data['subcategory'] = $this->commerce_m->get_all_subcategories();
		$data['category'] = $this->commerce_m->get_all_categories();
		if($category==NULL AND $subcategory==NULL){
			/* Метатэги */
			if ($this->uri->segment(1)=='ru'){
				$data['seo_title'] = "Акции";
				$data['seo_description'] = "Интернет-магазин ценит своих покупателей и регулярно проводит акции!";
				$data['seo_keywords'] = "Акции, купить дешевле, купить по акции, скидки на продукцию rich world";
				$data['seo_index'] = "1";
			}
			if ($this->uri->segment(1)=='en'){
				$data['seo_title'] = "Promotions";
				$data['seo_description'] = "Online Store loves its customers and regularly shares!";
				$data['seo_keywords'] = "Shares, bought cheaper, to buy on promotions, discounts on products rich world";
				$data['seo_index'] = "1";
			}
			
			/* Содержимое корзины */
			//$data['cart'] = $this->cart->contents();
			
			/* Блок авторизации */
			$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
			
			/* Получение новинок */
			/* Выбираем все категории и подкатегории*/
			$data['to_output'] = '';
			//$data['categories'] = $this->commerce_m->get_all_categories_novelty();
			$data['categories'] = $this->commerce_m->get_all_categories();
			foreach($data['categories'] as $cat)
			{
				$cat_exist = $this->commerce_m->product_promo_existing_cat($cat['id']);
				if ($cat_exist==true){
					$data['to_output'] .= '<h2>'.$cat['name'].'</h2>';
					$tmp['category_id'] = $cat['id'];
					$tmp['category_alias'] = $cat['alias'];
					$data['subcategories'] = $this->commerce_m->get_all_subcategories();
					foreach($data['subcategories'] as $subcat)
					{
						$tmp['subcategory_id'] = $subcat['id'];
						$tmp['subcategory_alias'] = $subcat['alias'];
						$subcat_exist = $this->commerce_m->product_promo_existing_subcat($cat['id'],$subcat['id']);
						if ($subcat_exist==true) {
							$data['to_output'] .= '<h3>'.$subcat[$subcat_index].'</h3>';
							
							$tmp['info'] = $this->commerce_m->get_promo_short($cat['id'],$subcat['id']);
							$tmp['cart'] = $this->cart->contents();
							//print_r ($tmp);
							/*foreach ($tmp as $value)
							{
								$data['to_output'] .= $value['name'];
							}*/
							if (count($tmp['info'])>0){$data['to_output'] .= $this->load->view('commerce/promo_catalog_element_v',$tmp,true);}
						}
					}
				}
			}
			
			
			//$data['novelties'] = $this->commerce_m->get_novelty_short(1,3);
			
			
			$data['content'] = $this->load->view('commerce/promo_v',$data,true);
			$this->load->view('main/index_v',$data);
		}
		if($category!=NULL AND $subcategory!=NULL){
			$category = mysql_real_escape_string($category);
			$subcategory = mysql_real_escape_string($subcategory);
				
				/* Метатэги */
			$data['seo_title'] = "Novelty";
			$data['seo_description'] = "Novelty";
			$data['seo_keywords'] = "Novelty";
			$data['seo_index'] = "1";
			/* Содержимое корзины */
			//$data['cart'] = $this->cart->contents();
			
			/* Блок авторизации */
			$data['auth_form'] = $this->load->module('auth')->auth_block_generator();
			
			/* Получение новинок */
			/* Выбираем все категории*/
			$data['category'] = $this->commerce_m->get_category_by_id($category);
			$data['subcategory'] = $this->commerce_m->get_subcategory_by_id($subcategory);
			$data['novelties'] = $this->commerce_m->get_promo_full($category,$subcategory);
			
			$tmp = $this->commerce_m->get_category_by_id($category);			
			$data['category_alias'] = $tmp['0']['alias'];
			$tmp = $this->commerce_m->get_subcategory_by_id($subcategory);
			$data['subcategory_alias'] = $tmp['0']['alias'];
			$data['cart'] = $this->cart->contents();
			$data['category_id'] = $category;
			$data['subcategory_id'] = $subcategory;
			
			
			$data['content'] = $this->load->view('commerce/promo_cat_subcat_v',$data,true);
			$this->load->view('main/index_v',$data);
		}
		if($category!=NULL AND $subcategory==NULL){redirect('404');}
	
	}
	
	function grocery_output($data=NULL)
	{
		return $this->load->view('admin/grocery_template_v',$data,true);
	}
	
	function show_products()
	{
		if ($this->session->userdata('level')!='99') redirect('forbidden');
		$this->load->library('grocery_crud');
		//$this->grocery_crud->set_theme('datatables');
		$this->grocery_crud->set_table('c_products');
		$this->grocery_crud->display_as('name','Название');
		$this->grocery_crud->display_as('name_tr','Название (EN)');
		$this->grocery_crud->display_as('category','Категория');
		$this->grocery_crud->display_as('subcategory','Подкатегория');
		$this->grocery_crud->display_as('description','Описание');
		$this->grocery_crud->display_as('description_tr','Описание (EN)');
		$this->grocery_crud->display_as('price-usd','Цена $');
		$this->grocery_crud->display_as('price-usd-promo','Цена $ (акция)');
		$this->grocery_crud->display_as('price-rub','Цена РУБ');
		$this->grocery_crud->display_as('type','Тип');
		$this->grocery_crud->display_as('price-rub-promo','Цена РУБ (акция)');
		$this->grocery_crud->display_as('image','Изображение');
		$this->grocery_crud->display_as('sku','Артикул');
		$this->grocery_crud->display_as('status','Статус');
		$this->grocery_crud->columns('id','image','category','subcategory','type','sku','name','status');
		//$this->grocery_crud->columns('image','category','subcategory','type','name','sku','description','price-rub','price_usd','status','novelty','recommended','promo');
		$this->grocery_crud->set_relation('category','c_category','name');
		$this->grocery_crud->set_relation('subcategory','c_subcategory','name');
		$this->grocery_crud->set_relation('type','c_type','rus');
		$this->grocery_crud->set_field_upload('image','assets/img/products');
		
		 $this->grocery_crud->add_action('More', base_url().'assets/grocery_crud/themes/flexigrid/css/images/edit.png', 'http://richworld-st.ru/admin/edit_product/','ui-icon-plus');
   
 
//		$this->grocery_crud->edit_fields('category','subcategory','name','name_tr','description','description_en');
		//$this->grocery_crud->add_action('Edit', '', 'demo/action_more','ui-icon-plus');
		//$this->grocery_crud->add_action('More', '', 'demo/action_more','ui-icon-plus');
		
		$grocery = $this->grocery_crud->render();
		echo "<h1>Все товары</h1>".$this->grocery_output($grocery);
	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
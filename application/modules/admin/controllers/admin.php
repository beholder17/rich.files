<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
		function __construct()
       {
            parent::__construct();					
			if ($this->session->userdata('level')!='99') redirect('forbidden');
       }
	
	public function kcfinder()
	{
		$this->load->helper('kcfinder');
		return kcfinder_config();		
	}
	
	public function index()
	{
		$data = array();
		$data['content'] = 'Административная часть сайта';
		
		$this->load->view('admin/index_v',$data);		
	}
	
	public function category()
	{	
		$this->load->model('commerce/commerce_admin_m');
		$tmp['data'] = $this->commerce_admin_m->get_all_categories();
		return $data['content'] = $this->load->view('commerce/admin/category_show_v',$tmp);
	}
	
	public function add_category()
	{
		$this->load->helper('my');
		$tmp = array();
		$tmp = json_decode($this->input->post('json_data'),true);
		$alias = make_alias($tmp['name']);
		$tmp2 = array('alias' => $alias);
		$data = array_merge ($tmp,$tmp2);
		$this->load->model('commerce/commerce_admin_m');
		$this->load->commerce_admin_m->add_category($data);
		//return "done";
	}
	
	public function edit_category()
	{
		$data = json_decode($this->input->post('json_data'),true);		
		//$data = array_replace($tmp,array('id'=>$tmp['id']));
		$this->load->model('commerce/commerce_admin_m');
		$this->load->commerce_admin_m->edit_category($data);
		/*return "done";*/
	}
	
	function del_category()
	{
		$tmp = json_decode($this->input->post('json_data'),true);
		$tmp['id']=preg_replace("/[^0-9]/","",$tmp['id']);
		$this->load->model('commerce/commerce_m');
		$this->load->commerce_m->del_category($tmp['id']);

	}
	
	function subcategory()
	{
		$this->load->model('commerce/commerce_admin_m');
		$tmp['data'] = $this->commerce_admin_m->get_all_subcategories();
		return $this->load->view('subcategory_v',$tmp);
	}
	
	function add_subcategory()
	{
		$this->load->helper('my');
		$tmp = array();
		$tmp = json_decode($this->input->post('json_data'),true);
		$alias = make_alias($tmp['name']);
		$tmp2 = array('alias' => $alias);
		$data = array_merge ($tmp,$tmp2);
		$this->load->model('commerce/commerce_admin_m');
		$this->load->commerce_admin_m->add_subcategory($data);
		return "done";
	}
	
	function del_subcategory()
	{
		if (!$this->input->post('json_data')) redirect('404');
		$tmp = json_decode($this->input->post('json_data'),true);		
		$this->load->model('commerce/commerce_m');
		$this->load->commerce_m->del_subcategory($tmp['id']);
	}
	
	function edit_subcategory()
	{
		if (!$this->input->post('json_data')) redirect('404');
		$data = json_decode($this->input->post('json_data'),true);		
		$this->load->model('commerce/commerce_admin_m');
		$this->load->commerce_admin_m->edit_subcategory($data);
	}
	
	function file_existing_check($filename)
	{}
		
	public function file_upload()
	{
		
		if ( 0 < $_FILES['file']['error'] ) {
				//echo 'Error: ' . $_FILES['file']['error'] . '<br>';
				echo "0";
			}
			else {
				$inc=0;
				//транслитерируем имя файла
				$this->load->helper('my');
				$_FILES['file']['name'] = file_name_translit($_FILES['file']['name']);
				
				//Проверка на наличие файла с таким именем в директории				
				$filename = 'template/'.$_FILES['file']['name'];
				loop:
				$inc++;
				if (file_exists($filename)) {
					echo "The file $filename exists";
					//new name creating
					$massive = pathinfo($_FILES['file']['name']);
					
					//$_FILES['file']['name'] = $massive['filename'].'('.$inc++.').'.$massive['extension'];
					$filename = 'template/'.$massive['filename'].' ('.$inc.').'.$massive['extension'];
					goto loop;
				} else {
					$_FILES['file']['name'] = $filename;
					move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
					echo "The file $filename does not exist";
					
				}


				echo "1".$_FILES['file']['tmp_name'];
				//echo "<script>alert('e".$_FILES['file']['tmp_name']."')</script>";
			}
	
	}
	
	public function make_thumbs_products($file_name)
	{
		//echo ">>>>>>>>".'application/assets/img/products/'.$file_name;
	//print_r($file_name);
		//$this->load->library('image_lib');
		
		$config['image_library'] = 'gd2'; // выбираем библиотеку
		$config['source_image']	= 'assets/img/products/'.$file_name; 
		$config['create_thumb'] = TRUE; // ставим флаг создания эскиза
		$config['maintain_ratio'] = TRUE; // сохранять пропорции
		$config['width']	= 300; // и задаем размеры
		$config['height']	= 300;
		$config['quality']	= '80';
		//$config['new_image'] = 'application/assets/img/products/thumbs/s'.$file_name;
		$config['new_image'] = 'assets/img/products/thumbs/';
		
		$this->load->library('image_lib', $config); // загружаем библиотеку 

		$this->image_lib->resize(); // и вызываем функцию
		
		if ( ! $this->image_lib->resize())
		{
			echo $this->image_lib->display_errors();
			//echo "<script>alert('$file_name');</script>";
		}
	}
	
	public function file_upload_ci()
	{
		$change = $this->input->post('change');
		//echo ">".$change."<";
		
	//	if ($change == 'changes_exists') {
	//	$_FILES['userfile']=$_FILES['file'];
		//print_r($_FILES);
		$config['upload_path'] = 'assets/img/products';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '8192';
		$config['max_width']  = '10240';
		$config['max_height']  = '7680';
		
		$this->load->library('upload', $config);
	//$this->upload->do_upload();
		if ( ! $this->upload->do_upload())
		{
			$error = json_encode (array('error' => $this->upload->display_errors()));
			
			print_r($error);
			//$this->load->view('upload_form', $error);
		}	
		else
		{
			$data = json_encode (array('upload_data' => $this->upload->data()));
			//echo "donedone<br>";
			print_r($data); //необходимо для порлучения данных родительским скриптом
			$file_name = $this->upload->data();
			$this->make_thumbs_products($file_name['file_name']);
			//$this->load->view('upload_success', $data);
		}
		//} else print_r(json_encode(''));
	}
		
	public function products($offset=0,$num=20)
	{
		$this->load->model('commerce/commerce_admin_m');
		$data['data'] = $this->commerce_admin_m->get_all_products($offset,$num);
		return $this->load->view('commerce/admin/products_v',$data);
	}
	
	public function add_product()
	{
		if (!$this->input->post('json_data')) {//redirect('404');
		$this->load->model('commerce/commerce_admin_m');
		$data['types'] = $this->commerce_admin_m->get_all_types();
		$data['categories'] = $this->commerce_admin_m->get_all_categories();
		$data['subcategories'] = $this->commerce_admin_m->get_all_subcategories();
		$data['content'] = $this->load->view('commerce/admin/add_product_v',$data); 
		}
		else 
		{
			
			$data = json_decode($this->input->post('json_data'),true);
			//$this->load->view('admin/text',$data);
			
			//$_FILES['userfile']=$_FILES['file'];
		/*	$config['upload_path'] = 'template';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '8192';
			$config['max_width']  = '10240';
			$config['max_height']  = '7680';
			
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());
				//print_r($error);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				//print_r($data);
			}
*/
			$this->load->model('commerce/commerce_admin_m');
			$this->commerce_admin_m->add_product($data);
		}
	}
	
	public function edit_product($id=null)
	{
		if (!$this->input->post('json_data') AND $id==NULL) {redirect('404');}
		if (!$this->input->post('json_data') AND $id!=NULL) {//redirect('404');
		$data = array();
		$this->load->model('commerce/commerce_admin_m');
		$data['product'] = $this->commerce_admin_m->get_product_by_id($id);
		$data['types'] = $this->commerce_admin_m->get_all_types();
		$data['categories'] = $this->commerce_admin_m->get_all_categories();
		$data['subcategories'] = $this->commerce_admin_m->get_all_subcategories();
		$data['id'] = $id;
		$data['content'] = $this->load->view('commerce/admin/edit_product_v',$data,true); 
		$this->load->view('admin/index_v',$data);
		}
		if ($this->input->post('json_data'))
		{
			$data = json_decode($this->input->post('json_data'),true);
			$id = json_decode($this->input->post('id'),true);
			unset($data['change']);
			//echo '>>>'.$id.'<<<';
			//echo "<br>";
			//print_r ($data);
			//echo "<br>";
			$this->load->model('commerce/commerce_admin_m');
			$this->commerce_admin_m->edit_apply_product($id, $data);
			echo "<script>alert('dfg $data - $id');</script>";
			//print_r ($rerer);
		}
		
	}
	
	function del_product()
	{
		if ($this->input->post('todel')){
			$id = $this->input->post('todel');
			$id = mysql_real_escape_string($id);
			$this->load->model('commerce/commerce_m');
			$this->commerce_m->del_product($id);
		}
		else redirect('404');
		//echo $this->input->post('todel');
	}
	
	
	
	public function send()
	{
		$this->load->library('email');
		$this->email->from('yv001@yandex.ru', 'YourName');
		$this->email->to('yv001@yandex.ru'); 
		$this->email->subject('Тест Email');
		$this->email->message('Тестирование класса отправки сообщений');	
		$this->email->send();
		echo $this->email->print_debugger();
	}
	
	function content_category()
	{
		$this->load->model('main/main_m');
		$data['content_category_list'] = $this->main_m->get_content_category();
		$this->load->view('main/admin/content_category_v',$data);
	}
	
	function add_content_category()
	{	if (!$this->input->post('json_data')) redirect('404');
		$this->load->helper('my');
		$tmp = array();
		$data = json_decode($this->input->post('json_data'),true);
		$this->load->model('main/main_admin_m');
		$this->load->main_admin_m->add_content_category($data);
	}
	
	function del_content_category()
	{
		if (!$this->input->post('json_data')) redirect('404');
		$tmp = json_decode($this->input->post('json_data'),true);		
		$this->load->model('main/main_admin_m');
		$this->load->main_admin_m->del_content_category($tmp['id']);
	}
	
	function edit_content_category()
	{
		if (!$this->input->post('json_data')) redirect('404');
		$data = json_decode($this->input->post('json_data'),true);		
		$this->load->model('main/main_admin_m');
		$this->load->main_admin_m->edit_content_category($data);
	}
	
	function content_manager()
	{
		$this->load->model('main/main_admin_m');
		$data['content_manager'] = $this->main_admin_m->get_content_list();
		$this->load->view('main/admin/content_manager_v',$data);
	}
	
	function add_content()
	{
		if (!$this->input->post('json_data')) {
		$this->load->model('main/main_admin_m');
		$data['content_category_list'] = $this->main_admin_m->get_content_category_list();
		$this->load->view('content/admin/add_content_v',$data);
		} else {
			$data = json_decode($this->input->post('json_data'),true);
			$this->load->model('main/main_admin_m');
			$this->load->main_admin_m->add_content($data);

		}
	}
	
	function edit_content($id=NULL)
	{
		if (!$this->input->post('json_data')) {
		
		
		$this->load->model('content/content_m');
		$this->load->model('main/main_admin_m');
		$data['content'] = $this->content_m->get_content_by_id($id);
		$data['content_category_list'] = $this->main_admin_m->get_content_category_list();
		
		//$data['slider'] = $this->slider_m->get_slider_by_id($id);
		$data['content'] = $this->load->view('content/admin/edit_content_v',$data,true); 
		$this->load->view('admin/index_v',$data);
		} else{
			$data = json_decode($this->input->post('json_data'),true);			
			
			$data['id'] = json_decode($this->input->post('id'),true);			
			if ($data['show']=='on') $data['show'] = 1; else $data['show'] = 0;
			
			print_r($data);
			
			
			$this->load->model('content/content_m');
			$this->content_m->update_content($data);
			
		}
	}
	
	function edit_page($id=NULL)
	{
		if (!$this->input->post('json_data')) {
		
		
		$this->load->model('content/content_m');
		$this->load->model('main/main_admin_m');
		$data['content'] = $this->content_m->get_page_by_id($id);
		$data['content_category_list'] = $this->main_admin_m->get_content_category_list();
		
		//$data['slider'] = $this->slider_m->get_slider_by_id($id);
		$data['content'] = $this->load->view('content/admin/edit_page_v',$data,true); 
		$this->load->view('admin/index_v',$data);
		} else{
			$data = json_decode($this->input->post('json_data'),true);			
			
			$data['id'] = json_decode($this->input->post('id'),true);			
			if ($data['show']=='on') $data['show'] = 1; else $data['show'] = 0;
			
			print_r($data);
			
			
			$this->load->model('content/content_m');
			$this->content_m->edit_page($data);
			
		}
	}
	
	function del_content()
	{
		if (!$this->input->post('id')) {redirect('forbidden');}
		//$data = json_decode($this->input->post('json_data'),true);			
		$data['id'] = json_decode($this->input->post('id'),true);			
			
			
			//print_r($data);
			
			
			$this->load->model('content/content_m');
			$this->content_m->del_content($data['id']);
			echo json_encode($data['id'].' was deleted');
	}
	
		function add_page()
	{
		if (!$this->input->post('json_data')) {
		redirect(base_url().'not_found');
		} else {
			$data = json_decode($this->input->post('json_data'),true);
			$this->load->model('main/main_admin_m');
			$this->load->main_admin_m->add_page($data);

		}
	}
	
	function add_slider()
	{
		
		
		if (!$this->input->post('json_data')) {//redirect('404');
	
		$this->load->model('main/main_admin_m');
		$data['content_category_list'] = $this->main_admin_m->get_content_category_list();
		$this->load->view('slider/admin/add_slider_v',$data);
		}
		else 
		{			
			$json_data = json_decode($this->input->post('json_data'),true);			
			if (isset($json_data['status'])) {if ($json_data['status']=='on') $data['status'] = 1; else $data['status'] = 0;} else $data['status'] = 0;
			unset($json_data['status']);
			$data['title'] = $json_data['name'];
			$data['destination'] = $json_data['destination'];
			unset($json_data['name']);
			$count = count($json_data)/4;
			for ($i = 0; $i < $count; $i++)
			{
				$ind = $i+1;
				$data['data'][$i] = array('img' => $json_data['img_'.$ind],
										'link' => $json_data['link_'.$ind],
										'img_alt' => $json_data['alt_'.$ind],
										'img_title' => $json_data['title_'.$ind]
				);
			}			
			
			//print_r($data['data']);
			$data['data'] = serialize($data['data']);
			$this->load->model('slider/slider_m');
			$this->slider_m->add_slider($data);
		}
	}
	
	function grocery_output($data=NULL)
	{
		return $this->load->view('grocery_template_v',$data,true);
	}
	
	function edit_slider($id=NULL)
	{
		if (!$this->input->post('json_data')) {
		
		$this->load->model('slider/slider_m');
		$data['slider'] = $this->slider_m->get_slider_by_id($id);
		
		$this->load->library('grocery_crud');
		$this->grocery_crud->set_table('slider');
		//$data['grocery'] = $this->grocery_crud->render();
		$grocery = $this->grocery_crud->render();
		$data['grocery'] = $this->grocery_output($grocery);
		
		
		//$this->grocery_crud->set_table('employees')
			//->set_field_upload('file_url','');// первый параметр - имя поля куда запишется имя файла
		//    $output = $this->grocery_crud->render();
		  //  $this->_example_output($output);
			
		
		
	
	
		$data['content'] = $this->load->view('slider/admin/edit_slider_v',$data,true); 
		$this->load->view('admin/index_v',$data);
		} else{
			$json_data = json_decode($this->input->post('json_data'),true);			
			$data['id'] = json_decode($this->input->post('id'),true);			
			if ($json_data['status']=='on') $data['status'] = 1; else $data['status'] = 0;
			unset($json_data['status']);
			$data['title'] = $json_data['name'];
			$data['destination'] = $json_data['destination'];
			unset($json_data['name']);
			$count = count($json_data)/5; // делитель - количество полей на один слайдер
			//$json_data = json_encode($json_data);
			print_r($json_data);
			for ($i = 0; $i < $count; $i++)
			{
				$ind = $i+1;
				$data['data'][$i] = array('img' => $json_data['img_'.$ind],
										'link' => $json_data['link_'.$ind],
										'img_alt' => $json_data['alt_'.$ind],
										'img_title' => $json_data['title_'.$ind]
				);
			}	
			$data['data'] = serialize($data['data']);
			$this->load->model('slider/slider_m');
			$this->slider_m->edit_slider($data);
		}
	}
	
	function apply_reviews()
	{
		$data = json_decode($this->input->post('json_data'),true);
		$id = $data['id'];
		unset($data['id']);
		if (!$data['show']) $data['show']='0'; else $data['show']=='1';
		$this->load->model('reviews/reviews_m');
		$this->reviews_m->apply_changes($id, $data);
	}
	
	function reviews_delete()
	{
		if ($this->input->post('json_data'))
		{
			$id = mysql_real_escape_string($this->input->post('json_data'));			
			$this->load->model('reviews/reviews_m');
			$this->reviews_m->review_delete($id);
		} 
	}
	
	function del_order()
	{
		if ($this->input->post('json_data'))
		{
			$id = mysql_real_escape_string($this->input->post('json_data'));			
			$this->load->model('commerce/commerce_admin_m');
			$this->commerce_admin_m->del_order($id);
		} 
	}
	
	function change_status_order()
	{
		if ($this->input->post('id') AND $this->input->post('value'))
		{
			$id = mysql_real_escape_string($this->input->post('id'));	
			$value = mysql_real_escape_string($this->input->post('value'));
			$this->load->model('commerce/commerce_admin_m');
			$this->commerce_admin_m->change_status_order($id,$value);
			
		}
		else redirect ('404');
	}
	
	function order_get_user_info()
	{
		
		if ($this->input->post('id'))
		{
			$id = mysql_real_escape_string($this->input->post('id'));
			$this->load->model('auth/auth_m');
			$this->load->model('commerce/commerce_admin_m');
			$data['user'] = $this->auth_m->get_user_by_id($id);
			$data['orders'] = $this->commerce_admin_m->orders_of_user($id);
			$this->load->view('commerce/admin/get_user_info_v',$data);
		} else redirect('404');
	}
}
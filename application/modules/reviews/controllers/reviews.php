<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends MX_Controller
{


    public function index()
    {
//Cache-Control: max-age=3600, must-revalidate

	 //$last_update = "Fri, 02 Oct 2015 15:45:41";
	$this->output->set_header("HTTP/1.0 200 OK");
$this->output->set_header("HTTP/1.1 200 OK");
$this->output->set_header('Last-Modified: Fri, 02 Oct 2015 15:45:41 GMT');
$this->output->set_header("Cache-Control: max-age=3600, must-revalidate");
//$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
//$this->output->set_header("Pragma: no-cache");
	
        // Получаем меню для сайдбара
        $this->load->model('commerce/commerce_m');
        $data['subcategory'] = $this->commerce_m->get_all_subcategories();
        $data['category'] = $this->commerce_m->get_all_categories();


        //error_reporting(0);
        /* Получаем слайдер */
        //$data['slider'] = $this->load->view('main_slider_v','',true);
        $this->load->model('reviews_m');

        /* pager */
        $this->load->library('pager');
        $current_page_check = $this->input->get('page');
        if ($current_page_check!='') { $current_page_value = $this->input->get('page');} else { $current_page_value = 1; }
        $config['base_url'] = base_url().$this->uri->segment(1).'/reviews';
        $config['total_rows'] = $this->reviews_m->get_approved_reviews_count();
        $config['per_page'] = "5";
        $config['current_page'] = $current_page_value;
        $this->pager->initializer($config);
        $data['pager'] = $this->pager->create_links();

        // Получаем одобренные отзывы

        //$data['approved_reviews'] = $this->reviews_m->get_all_approved_reviews();
        $data['approved_reviews'] = $this->reviews_m->get_all_approved_reviews($config['per_page'],$this->pager->requested_page());
        $data['content'] = $this->load->view('reviews_main_page_v', $data, true);






        /* Метатэги */
        $data['seo_title'] = "Отзывы о продукции Rich World";
        $data['seo_description'] = "Отзывы о продукции Rich World, здесь вы можете оставить свой отзыв!";
        $data['seo_keywords'] = "Rich World, продукция, отзывы о продукции, отзывы об интернет-магазине richworld-st.ru";

        /* Блок авторизации */
        $data['auth_form'] = $this->load->module('auth')->auth_block_generator();
		
		/* Хлебные крошки */					
		if ($this->uri->segment(1) == 'en') {
			$home = 'Home';
			$reviews = 'Reviews';		
		}
		if ($this->uri->segment(1) == 'ru') {				
			$home = 'Главная';
			$reviews = 'Отзывы';
		
		}
		$this->breadcrumbs->push($home, $this->uri->segment(1));
		$this->breadcrumbs->push($reviews, $this->uri->segment(1).'/reviews');			
		$data['breadcrumbs'] = $this->breadcrumbs->show();

        $this->load->view('main/index_v', $data);
    }

    function add_review()
    {$this->output->cache(3);
        // Получаем меню для сайдбара
        $this->load->model('commerce/commerce_m');
        $data['subcategory'] = $this->commerce_m->get_all_subcategories();
        $data['category'] = $this->commerce_m->get_all_categories();
        $this->load->model('reviews_m');
        $this->load->library('form_validation');
		
        if (isset($_POST['add'])){
			$data['form_data'] = $this->input->post();
            $this->form_validation->set_rules($this->reviews_m->add_review_rules);
			$check = $this->form_validation->run();
            if ($check == FALSE)
            {
                $data['content'] = $this->load->view('review_add_v',$data,true);
                /* Метатэги */
                $data['seo_title'] = "reviews";
                $data['seo_description'] = "reviews";
                $data['seo_keywords'] = "reviews seo_keywords";

                /* Блок авторизации */
                $data['auth_form'] = $this->load->module('auth')->auth_block_generator();

                $this->load->view('main/index_v', $data);
				
				
            }
            else
            {
				
				//if file selected
				
					$tmp = $this->go_upload_img($_FILES['userfile'],'assets/reviews_img/',150,150);
					if ($tmp == false) {echo "Загрузка файла не удалась"; exit;} else {
						$this->load->model('reviews_m');
						$data['model'] = $this->input->post();						
						
						
						unset ($data['model']['add']);
							unset ($data['model']['upload_data']);
							$data['model']['image'] = $tmp;
							//var_dump($data['model']);
							$this->reviews_m->add_review($data['model']);
						redirect (base_url().$this->uri->segment(1).'/reviews');
					}
					//TODO:отправка уведомления
					
			}
            

        } else {


            $data['content'] = $this->load->view('review_add_v','',true);

            /* Метатэги */
            $data['seo_title'] = "reviews";
            $data['seo_description'] = "reviews";
            $data['seo_keywords'] = "reviews seo_keywords";

            /* Блок авторизации */
            $data['auth_form'] = $this->load->module('auth')->auth_block_generator();

            $this->load->view('main/index_v', $data);

        }




    }
	
	function adm_reviews($param=null)
	{
		$this->load->model('reviews_m');
		if ($param == 'unpublish') {$data['reviews'] = $this->reviews_m->get_all_unpublish_reviews();}
		if ($param == 'publish') {$data['reviews'] = $this->reviews_m->get_all_reviews();}
		if ($param == null) {$data['reviews'] = $this->reviews_m->get_all_reviews();}
		$this->load->view('reviews/admin/adm_reviews_v',$data);
	}
	/*
	function update_user_info()
	{
		
	}*/
	
	//Upload, crop and resize images
	function go_upload_img($file,$path,$width,$height)
	{
		if ($file==NULL OR $path==NULL OR $width==NULL OR $height==NULL) redirect ('404');
		//-------------------------------------------
		// WHERE:
		// $path - destination path from root of site with '/' at it ends (ex.: 'assets/avatars/') !IMPORTANT
		// $width, $height - size for image manipulations
		// RETURN: file name if success or false if error
		//-------------------------------------------
		$_POST['upload_data'] = $file;
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '400';
		$config['max_width']  = '2024';
		$config['max_height']  = '1768';
		$config['encrypt_name']  = true;
		$this->load->library('upload', $config);	
		if (!$this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors());			
			echo $error['error'];
			return false;
		}
		else {			
			$data = array('upload_data' => $this->upload->data());
			$sizes = getimagesize($path.$data['upload_data']['file_name']);
			/* Image manipulations: */
			$config['image_library'] = 'gd2'; // choose library
			$config['source_image']	= $path.$data['upload_data']['file_name'];
			$config['new_image']	= $path.$data['upload_data']['file_name'];				
			$config['create_thumb'] = TRUE; // ставим флаг создания эскиза
			$config['thumb_marker'] = ''; 
			$config['maintain_ratio'] = FALSE; // сохранять пропорции
			// CROP
			// Horizontal orientation
			if ($sizes[0]>$sizes[1]) {
				$config['width']	= $sizes[1]; // и задаем размеры
				$config['height']	= $sizes[1];
				$config['x_axis'] =   round(($sizes[0]/2)-round($sizes[1]/2));
				
				$this->load->library('image_lib',$config);
				$this->image_lib->crop();				
			}
			// Vertical orientation
			if ($sizes[0]<$sizes[1]) {
				$config['width']	= $sizes[0]; // и задаем размеры
				$config['height']	= $sizes[0];
				$config['y_axis'] =   round(($sizes[1]/2)-round($sizes[0]/2));				
				$this->load->library('image_lib',$config);
				$this->image_lib->crop();				
			}
			// Quadro orientation
			if ($sizes[0]=$sizes[1]) {
				$config['width']	= $sizes[0]; // и задаем размеры
				$config['height']	= $sizes[0];				
				$this->load->library('image_lib',$config);
				$this->image_lib->crop();				
			}
			///////////////////////
			// Image Change Size //
			///////////////////////
			$config['width']			= $width;
			$config['height']			= $height;
			$this->load->library("image_lib");
			$this->image_lib->initialize($config);
			if ( ! $this->image_lib->resize()){echo $this->image_lib->display_errors();}
			return $data['upload_data']['file_name'];
		}
	}
	


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
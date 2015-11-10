<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('go_upload_img'))
{
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
		$CI =& get_instance();
		$_POST['upload_data'] = $file;
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '400';
		$config['max_width']  = '2024';
		$config['max_height']  = '1768';
		$config['encrypt_name']  = true;
		$CI->load->library('upload', $config);
		if (!$CI->upload->do_upload()){
			$error = array('error' => $CI->upload->display_errors());			
			echo $error['error'];
			return false;
		}
		else {			
			$data = array('upload_data' => $CI->upload->data());
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
				
				$CI->load->library('image_lib',$config);
				$CI->image_lib->crop();				
			}
			// Vertical orientation
			if ($sizes[0]<$sizes[1]) {
				$config['width']	= $sizes[0]; // и задаем размеры
				$config['height']	= $sizes[0];
				$config['y_axis'] =   round(($sizes[1]/2)-round($sizes[0]/2));				
				$CI->load->library('image_lib',$config);
				$CI->image_lib->crop();				
			}
			// Quadro orientation
			if ($sizes[0]=$sizes[1]) {
				$config['width']	= $sizes[0]; // и задаем размеры
				$config['height']	= $sizes[0];				
				$CI->load->library('image_lib',$config);
				$CI->image_lib->crop();				
			}
			///////////////////////
			// Image Change Size //
			///////////////////////
			$config['width']			= $width;
			$config['height']			= $height;
			$CI->load->library("image_lib");
			$CI->image_lib->initialize($config);
			if ( ! $CI->image_lib->resize()){echo $CI->image_lib->display_errors();}
			return $data['upload_data']['file_name'];
		}
	}
}

/* Пример обращения к функции go_upload_img
	function img_cru_do()
	{
		if ($this->input->post('send')==NULL) redirect('404');
		$this->load->helper('img_cru');
		//if file selected
		if ($_FILES['userfile']['tmp_name']!=false){
			$tmp = go_upload_img($_FILES['userfile'],'assets/test/',234,234);
			if ($tmp == false) {echo "Загрузка файла не удалась"; exit;} else {
				$data = $this->input->post();
				unset ($data['send']);
				unset ($data['upload_data']);
				$data['avatar'] = $tmp;
				//redirect (base_url().$this->uri->segment(1).'/auth/account/userinfo');
			}
		} else {
			$data = $this->input->post();
			unset ($data['send']);			
			//redirect (base_url().$this->uri->segment(1).'/auth/account/userinfo');
		}
	}
	Пример формы
	<form method='post' action='welcome/img_cru_do' enctype="multipart/form-data" >
	<label for='userfile'>Upload</label><input type='file' name='userfile'>
	<input type='submit' name='send' value='upload img'>
	</form>
*/
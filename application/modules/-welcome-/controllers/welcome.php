<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	/*public function index()
	{
		$this->load->view('welcome_message');
	}*/
	
	/*function img_cru_do()
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
	}*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
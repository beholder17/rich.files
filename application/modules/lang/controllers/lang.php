<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lang extends MX_Controller {

	private $_controller;
    public function __construct()
    {
        parent::__construct();
        /* Если не выбран язык, то ставим язык по-умолчанию,
* переадресовывая пользователя на правильный URL
*/
    //    $this->_check_lang(); 
	
    }
	
	public function switcher()
	{
		$string = uri_string();	
		$data['link'] = substr($string,3);
		$lang = $this->config->item('language_site');
		$this->load->view('lang/switcher_v',$data);
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
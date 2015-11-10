<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/libraries/MX/Controller.php
 *
 * @copyright	Copyright (c) 2011 Wiredesignz
 * @version 	5.4
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller
{
	public $autoload = array();
	
	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);
		$this->_check_lang();
	}
	
	public function __get($class) {
		return CI::$APP->$class;
	}
	
	public function _check_lang()
    {
		
        $lang = $this->config->item('language_site'); /* получаем языки сайта из конфига*/
        
		//print_r($lang);
        if (file_exists(APPPATH . 'modules/lang'))
        {
            $uri_string = $this->uri->uri_string(); /* получаем строку нашего url */
			//print_r($uri_string);
			//echo "<script>alert('e".$this->uri->uri_string()."')</script>";
            /* Если мы не находим язык по первому сегменту в нашем url
             * то переадресовываем пользователя на такую же ссылку только
			 * добавляем в начало, язык сайта по-умолчанию.
			  */
            if (!isset($lang[$this->uri->segment(1)])) {
                //redirect($lang['default'].'/'.$uri_string, 'location', 301);
				$tmp = base_url().$lang['default'].$uri_string;
				//echo "<script>alert('".$tmp."')</script>";
				redirect($tmp, 'location', 301);
            }
            
        }
    }
}
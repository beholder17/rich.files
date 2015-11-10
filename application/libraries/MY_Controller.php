<?php
class MY_Controller extends MX_Controller {
	
	/**
     * Проверка наличия языка сайта в ссылке
     * и переедресация на язык по-умолчанию
     * в случае если мы его там его не нашли
     */
    public function _check_lang()
    {
		echo "<script>alert('df')</script>";
        $lang = $this->config->item('language_site'); /* получаем языки сайта из конфига*/
        
        if (file_exists(APPPATH . 'modules/lang'))
        {
            $uri_string = $this->uri->uri_string(); /* получаем строку нашего url */
            /* Если мы не находим язык по первому сегменту в нашем url
             * то переадресовываем пользователя на такую же ссылку только
            * добавляем в начало, язык сайта по-умолчанию.
            */
            if (!isset($lang[$this->uri->segment(1)])) { 
                redirect($lang['default'].'/'.$uri_string, 'location', 301);
            }
            
        }
    }
}
?>
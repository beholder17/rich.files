<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['404'] = "404";
//$route['default_controller'] = "main";
if (file_exists(APPPATH . 'modules/lang'))
{
    $route['default_controller'] = "lang";
    $route['(ru|en|tr)'] = $this->config->item('default_controller');
    $route['(ru|en|tr)/lang/switcher'] = "lang/switcher";
} else {
    $route['default_controller'] = $this->config->item('default_controller');
}


$route['404_override'] = 'main/notfound';



/* Переопределение */

include "content_routes.php";
include "main_pages_routes.php";


$route['(ru|en|tr)/contacts'] = "contacts";
$route['(ru|en|tr)/contacts/(:any)'] = "contacts/$2";



//$route['(ru|en)/catalog'] = "commerce/catalog";
/*$route['(ru|en|tr)/commerce/no_products'] = "commerce/no_products";
$route['(ru|en|tr)/commerce/cart'] = "commerce/cart";
$route['(ru|en|tr)/commerce/cart_calculate'] = "commerce/cart_calculate";
$route['(ru|en|tr)/commerce/checkout'] = "commerce/checkout";
$route['(ru|en|tr)/commerce/add_to_cart'] = "commerce/add_to_cart";
$route['(ru|en|tr)/commerce/cart_drop'] = "commerce/cart_drop";
$route['(ru|en|tr)/commerce/cart_remove_item'] = "commerce/cart_remove_item";*/
$route['(ru|en|tr)/commerce/(:any)'] = "commerce/$2";

/*$route['(ru|en|tr)/auth/login'] = "auth/login";
$route['(ru|en|tr)/auth/auth_check_ajax'] = "auth/auth_check_ajax";
$route['(ru|en|tr)/auth/registration'] = "auth/registration";*/
$route['(ru|en|tr)/auth/(:any)'] = "auth/$2";


$route['(ru|en|tr)/search'] = "search";

$route['(ru|en)/sidebar'] = "sidebar";
$route['(ru|en)/sidebar/(:any)'] = "sidebar/$2";


$route['(ru|en|tr)/reviews'] = "reviews";
$route['(ru|en|tr)/reviews/(:any)'] = "reviews/$2";




$route['(ru|en|tr)/catalog/:any'] = "commerce/catalog/([a-z]+)";
$route['(ru|en|tr)/catalog'] = "commerce/catalog";
$route['(ru|en|tr)/catalog/:any/:any/'] = "commerce/catalog/([a-z]+)/([a-z]+)";




//$route['admin'] = "admin";
//$route['admin/add_category'] = "admin/add_category";
//$route['admin/:any'] = "admin/$1";

/* Страница - на основе стартового контроллера */
//http://rich_t.ru/index.php/main/index/kh
//$route[':any'] = "main/index/:any";
//$route[':any'] = "main/index/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */
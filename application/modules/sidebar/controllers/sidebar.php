<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sidebar extends MX_Controller {
	
	function index()
	{
		echo '
		<html>
		<head>
		 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		   <meta http-equiv="expires" content="01 Dec 2015 07:01:00 GMT">
		</head>
		<body>
		gh
		</body>
		</html>
		';
		
	}
	
	public function show()
	{
		$this->output->cache(1);
		$this->load->library('partialcache');
		$cacheContent = $this->load->view('main/index_v');
		$this->partialcache->save('some', $cacheContent);
	}
	
}
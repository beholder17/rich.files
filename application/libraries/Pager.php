<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pager {
	public $current_page;
	public $base_url;
	public $total_rows;
	public $per_page;
	public $requested_page;
	public $links;

	
	function initializer($config)
	{
		$this->base_url = $config['base_url'];
		$this->total_rows = $config['total_rows'];
		$this->per_page = $config['per_page'];
		//echo "<script>alert('>".$config['current_page']."<');</script>";
		
		if ($config['current_page']=='') {$pager_current_page = 1;} else {$pager_current_page = $config['current_page'];}
		
		if (intval($config['current_page'])!=false){
		$pager_current_page = intval($config['current_page']);
		$this->current_page = $pager_current_page;
		$this->requested_page = $pager_current_page * $this->per_page - $this->per_page; 
		} else { //redirect(base_url().'404');
		echo "<script>document.location.href = '".base_url()."404';</script>";		
		//echo "<script>alert('".print_r($this->pager_current_page)."');</script>";
		}
		
		$this->initialize();
	}

    function initialize()
    {		
		
		$total_pages = ceil ($this->total_rows/$this->per_page);
		$pager_view = "<ul class='pager_ul' style='list-style: none'>";
		if ($this->current_page>$total_pages OR $this->current_page<1) { echo "<script>document.location.href = '".base_url()."404';</script>";
		//echo "<script>alert('location2');</script>";
		}
		
		//if ($this->current_page!=1) $pager_view = $pager_view."<li class='first_page'><a href='".$this->base_url."?page=1'>First</a></li>";
		
		for ($i = 1; $i<$total_pages+1; $i++)
		{
			if (isset($this->current_page) AND $this->current_page==$i) {
			$pager_view = $pager_view."<li class='active'>$i</li>";
			} else {
			$pager_view = $pager_view."<li><a href='".$this->base_url."?page=$i'>$i</a></li>";
			}
		}
		//if ($this->current_page!=$total_pages) $pager_view = $pager_view."<li class='last_page'><a href='".$this->base_url."?page=$total_pages'>Last</a></li>";
		$pager_view = $pager_view."</ul>";
		
		/*Если одна страница*/
		if ($total_pages == 1 ) {$pager_view='';}
		
		
		 $this->links = $pager_view;
    }
	
	function create_links()
	{
		$pager = "<div class='pager'>".$this->links."</div>";
		return $pager;
	}
	
	function requested_page()
	{
		return $this->requested_page;
	}
}

?>
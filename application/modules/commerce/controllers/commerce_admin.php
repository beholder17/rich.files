<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commerce_admin extends CI_Controller {
	
	/*public function add_category($data)
	{
		print_r($data);
		//$this->db->insert('c_category',$data);
	}
	
	public function catalog()
	{
		$this->load->library('pagination');
		$this->load->model('commerce_m');
		$category = $this->uri->segment(2);
		$subcategory = $this->uri->segment(3);
		
		
		if ($category!=null AND $subcategory==null){
				//echo "<script>alert('1 $category - $subcategory');</script>";
				
				$data['content'] = $this->commerce_m->get_category($category);
				$data['content'] = $this->load->view('commerce_v',$data,true);
				}
		if ($category!=null AND $subcategory!=null){
				//echo "<script>alert('2 $category - $subcategory');</script>";
				
				
				

				// pager //
				$this->load->library('pager');
				
				$tmp = $this->input->get('page');
				if ($tmp!='') $current_page_value = $this->input->get('page'); else $current_page_value = 1;
				$config['base_url'] = base_url().'catalog/rich-world/geli-dlya-narashivaniya-nogtei';
				$config['total_rows'] = $this->commerce_m->get_products_count($category);
				$config['per_page'] = 3;
				$config['current_page'] = $current_page_value;
				
				$this->pager->initializer($config); 				
				//$this->pager->initialize(); 

				$data['pager'] = $this->pager->create_links();
				
				$data['content'] = $this->commerce_m->get_catalog($category,$subcategory,$config['per_page'],$this->pager->requested_page());
				
				$data['content'] = $this->load->view('catalog_v',$data,true);
				
				$this->load->view('main/index_v',$data);
				
		}
		if ($category==null AND $subcategory==null){
				echo "<script>alert('3 $category - $subcategory');</script>";
				$data['content'] = 'все категории без каких-либо идентификаторов';
				
		}
		
		
	}
*/
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
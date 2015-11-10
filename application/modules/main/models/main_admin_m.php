<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_admin_m extends CI_Model {
	
	
	function add_content($data)
	{	
		$check = $this->db->insert('content',$data);
		return $check;
	}
	
	function add_page($data)
	{	
		$check = $this->db->insert('pages',$data);
		return $check;
	}
	
	
	function add_content_category($data)
	{
		$this->db->insert('content_category',$data);
		return $data;
	}
	
	function del_content_category($alias)
	{	
		$sql ="DELETE FROM `content_category` WHERE id = $alias";
		$query = $this->db->query($sql);
		return true;		
	}
	
	function edit_content_category($data)
	{
		
		$this->db->where('id',$data['id']);
		$this->db->update('content_category',$data);
		
	}
	
	function get_content_list($offset=null,$num=null)
	{
		$this->db->limit(10,0);
		return $this->db->get('content')->result_array();
	}
	
	function get_content_category_list()
	{
		return $this->db->get('content_category')->result_array();
	}
	
}
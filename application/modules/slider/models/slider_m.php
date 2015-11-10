<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class slider_m extends CI_Model {

	public function getslider($title=NULL)
	{   
		$sql = "SELECT * FROM `slider` WHERE `status`=? AND `destination` like '%$title%'";
		$query = $this->db->query($sql,array(1,$title));
		return $query->result_array();
	}
	
	public function add_slider($data)
	{   
		/*$sql = "SELECT * FROM `slider` WHERE `status`=? AND `destination` = ?";
		$query = $this->db->query($sql,array(1,$title));
		return $query->result_array();*/
		$this->db->insert('slider',$data);
	}
	
	public function get_slider_by_id($id=NULL)
	{   
		$sql = "SELECT * FROM `slider` WHERE `id`=?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	
	public function edit_slider($data=NULL)
	{   
		$this->db->where('id',$data['id']);
		$this->db->update('slider',$data);
	}

	
	
}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_m extends CI_Model {

	public function get_content($category,$alias)
	{
		$sql ="SELECT * FROM `content` WHERE `alias` = ?";
		$query = $this->db->query($sql,$alias);
		return $query->result_array();
	}
	public function get_category_list($category,$num, $offset)
	{
		$sql ="SELECT content.id, content.title,content.title_tr, content.description, content.keywords, content.fulltext,content.fulltext_tr, content.date, content.show, content.author, content.alias, content.visit_counter, content.image, content_category.category, content_category.name
		FROM content
		INNER JOIN content_category 
		ON content_category.id = content.category
		WHERE content_category.category =  '$category'
		AND content.show = '1'
		ORDER BY date DESC
		LIMIT $offset,$num";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_category_by_alias($alias)
	{
		$sql ="SELECT * FROM `content_category` WHERE `category` = ?";
		$query = $this->db->query($sql,$alias);
		return $query->result_array();
	}
	
	public function get_material_count($category)
	{
		$sql ="SELECT content.id, content.title, content.description, content.keywords, content.fulltext, content.date, content.show, content.author, content.alias, content.visit_counter, content.image, content_category.category, content_category.name
		FROM content
		INNER JOIN content_category 
		ON content_category.id = content.category
		WHERE content_category.category =  '$category'
		AND content.show = '1'
		";		
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function get_content_block($category,$num)
	{
		$sql ="SELECT content.id, content.title,content.title_tr, content.description, content.keywords, content.fulltext, content.fulltext_tr, content.date, content.show, content.author, content.alias, content.visit_counter, content.image, content_category.category, content_category.name
		FROM content
		INNER JOIN content_category 
		ON content_category.id = content.category
		WHERE content_category.category =  '$category' AND content.show = '1'
		ORDER BY date DESC
		LIMIT 0,$num
		";	
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_content_by_id($id)
	{
		$sql ="SELECT content.id, content.title, content.title_tr, content.description,content.description_tr, content.keywords,content.keywords_tr, content.fulltext,content.fulltext_tr, content.date, content.show, content.author, content.alias, content.visit_counter, content.image, content_category.category, content_category.name, content.category AS category_id
		FROM content
		INNER JOIN content_category 
		ON content_category.id = content.category
		WHERE content.id =  ?		
		ORDER BY date DESC";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	
	public function get_page_by_id($id)
	{
		$sql ="SELECT *
		FROM pages		
		WHERE id =  ?
		";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	
	function update_content($data)
	{
		//echo "!!!".$data['id'];
		//unset($data['fulltext']);
		//print_r ($data);
		$this->db->where('id',$data['id']);
		$this->db->update('content',$data);
	}
	
	
	function edit_page($data)
	{
		//echo "!!!".$data['id'];
		//unset($data['fulltext']);
		//print_r ($data);
		$this->db->where('id',$data['id']);
		$this->db->update('pages',$data);
	}
	
	
	function del_content($id)
	{
		$this->db->delete('content',array('id'=>$id));
	}
}

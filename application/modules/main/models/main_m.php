<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_m extends CI_Model {

	public function get_page($alias)
	{
		$sql ="SELECT * FROM `pages` WHERE `alias` = '$alias'";
		$query = $this->db->query($sql);
		return $query->result_array();
		/*
		Транскрипция результатов:
		
		
		*/
	}
	public function get_category_list($category,$num, $offset)
	{
		$sql ="SELECT content.id, content.title, content.description, content.keywords, content.fulltext, content.date, content.show, content.author, content.alias, content.visit_counter, content.image, content_category.category, content_category.name
		FROM content
		INNER JOIN content_category 
		ON content_category.id = content.category
		WHERE content_category.category =  '$category'
		ORDER BY date DESC";
		if (isset($offset) && $offset!='') $sql = $sql." LIMIT $offset,$num"; else $sql = $sql." LIMIT 0,".PAGINATION_PER_PAGE;
		$query = $this->db->query($sql);
		return $query->result_array();
		/*echo '<script>alert("fff");</script>Всего результатов: ' . $query->num_rows();*/
	}
	public function get_material_count($category)
	{
		$sql ="SELECT content.id, content.title, content.description, content.keywords, content.fulltext, content.date, content.show, content.author, content.alias, content.visit_counter, content.image, content_category.category, content_category.name
		FROM content
		INNER JOIN content_category 
		ON content_category.id = content.category
		WHERE content_category.category =  '$category'
		";		
		$query = $this->db->query($sql);
		return $query->num_rows();
		/*echo '<script>alert("fff");</script>Всего результатов: ' . $query->num_rows();*/
	}

	public function get_content_block($category,$num)
	{
		$sql ="SELECT content.id, content.title, content.description, content.keywords, content.fulltext, content.date, content.show, content.author, content.alias, content.visit_counter, content.image, content_category.category, content_category.name
		FROM content
		INNER JOIN content_category 
		ON content_category.id = content.category
		WHERE content_category.category =  '$category'		
		ORDER BY date DESC
		LIMIT 0,$num
		";	
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_content_category()
	{
		return $this->db->get('content_category')->result_array();
	}
	
	
}

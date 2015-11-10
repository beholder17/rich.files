<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_m extends CI_Model {

	public function search_text($text=NULL,$per=NULL,$current=NULL)
	{
		$sql ="SELECT  `alias` ,  `title` ,  `content_category`.`category`,`show`,'content' as tablename
		FROM  `content` 
		INNER JOIN  `content_category` ON  `content`.`category` =  `content_category`.`id` 
		WHERE  `title` LIKE  '%$text%'
		UNION 
		SELECT `c_products`.`id`,`c_products`.`name`,`c_category`.`alias` AS 'category',`c_subcategory`.`alias` AS 'subcategory','c_products' as tablename
		FROM 
		`c_products` 
		INNER JOIN `c_category`
		ON c_products.category = c_category.id
                INNER JOIN `c_subcategory`
		ON c_products.subcategory = c_subcategory.id
		WHERE `c_products`.`description` 
		like '%$text%' 
		OR 
		`c_products`.`name` 
		like '%$text%'";
		if ($per!=NULL AND $current!=NULL) $sql = $sql." LIMIT $per,$current";
		
		$query = $this->db->query($sql);
		$result['result'] = $query->result_array();
		$result['count'] =  $query->num_rows();
		$result['query'] =  $sql;
		return $result;
	}
	
	/*public function get_results_count($text)
	{
		$sql ="SELECT  `alias` ,  `title` ,  `content_category`.`category`,`show`,'content' as tablename
		FROM  `content` 
		INNER JOIN  `content_category` ON  `content`.`category` =  `content_category`.`id` 
		WHERE  `title` LIKE  '%$text%'
		UNION 
		SELECT `c_products`.`id`,`c_products`.`name`,`c_category`.`alias` AS 'category',`c_subcategory`.`alias` AS 'subcategory','c_products' as tablename
		FROM 
		`c_products` 
		INNER JOIN `c_category`
		ON c_products.category = c_category.id
                INNER JOIN `c_subcategory`
		ON c_products.subcategory = c_subcategory.id
		WHERE `c_products`.`description` 
		like '%$text%' 
		OR 
		`c_products`.`name` 
		like '%$text%'
		";	
		$query = $this->db->query($sql);
		return $query->num_rows();
	}*/
	
}

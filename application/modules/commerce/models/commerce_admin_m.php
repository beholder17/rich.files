<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commerce_admin_m extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	//public function check_auth_model($li)
	
	
	
	public function add_category($data)
	{
		$this->db->insert('c_category',$data);
	}
	
	public function edit_category($data)
	{
		//$tmp['id']=preg_replace("/[^0-9]/","",$data['id']);
		$this->db->where('id',$data['id']);
		$this->db->update('c_category',$data);
	}
	
	public function get_all_categories()
	{
		$sql ="SELECT * FROM `c_category`";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_all_subcategories()
	{
		$sql ="SELECT * FROM `c_subcategory`";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
		public function add_subcategory($data)
	{
		$this->db->insert('c_subcategory',$data);
	}
		
		public function edit_subcategory($data)
	{
		$this->db->where('id',$data['id']);
		$this->db->update('c_subcategory',$data);
	}
	
	public function get_category($alias)
	{
		$sql ="SELECT * FROM `c_category` WHERE `alias` = '$alias'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_catalog($category, $subcategory,$num, $offset)
	{
		if (!$offset) $offset = 0;
		$sql ="SELECT * FROM `c_products` WHERE `category` = '1' AND `subcategory` = '1'  LIMIT $offset,$num";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_products_count($category)
	{
		$sql ="SELECT c_products.id
		FROM c_products		
		WHERE c_products.category =  '1'
		";		
		$query = $this->db->query($sql);
		return $query->num_rows();
		/*echo '<script>alert("fff");</script>Всего результатов: ' . $query->num_rows();*/
	}
	
	public function add_product($data)
	{
		echo "print";
		$this->db->insert('c_products',$data);
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
	
		public function get_all_types()
	{
		$sql ="SELECT * FROM `c_type`";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
		public function get_all_products($offset,$num)
	{
		$sql ="SELECT
			c_products.id,
			c_products.name,
			c_category.name AS `category`,
			c_subcategory.name AS `subcategory`,
			c_products.description,
			c_products.`price-usd`,
			c_products.`price-usd-promo`,
			c_products.`price-try`,
			c_products.`price-try-promo`,
			c_products.`price-rub`,
			c_products.`price-rub-promo`,
			c_products.image,
			c_products.sku,
			c_products.status,
			c_products.novelty,
			c_products.recommended,
			c_products.promo,
			c_type.`title-rus` AS `type`,
			c_products.volume,
			c_products.width,
			c_products.height,
			c_products.thickness,
			c_products.weight,
			c_products.material,
			c_products.abrasiveness,
			c_products.seo_title,
			c_products.seo_description,
			c_products.seo_keywords
			FROM c_products
			INNER JOIN c_category
			ON c_products.category = c_category.id
			INNER JOIN c_subcategory
			ON c_products.subcategory = c_subcategory.id
			INNER JOIN c_type
			ON c_products.type = c_type.id
			LIMIT $offset,$num
			";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_product_by_id($id)
	{
		
		$sql ="SELECT * FROM `c_products` WHERE `id` = ?";
		$query = $this->db->query($sql,array($id));
		return $query->result_array();
	}
	
	public function edit_apply_product($id, $data)
	{
		$this->db->where('id', $id);
		$query = $this->db->update('c_products', $data); 
		return $query;
		/*$sql ="UPDATE `c_products` SET `name` = ? WHERE `id` = ?";
		$query = $this->db->query($sql,array($data['name'],$id));*/
		//return $query();
	}
	
	public function get_orders()
	{
		//$sql = "SELECT * FROM `c_orders`";
		$sql = "SELECT 	`c_orders`.`id`,
						`c_orders`.`user_id`,
						`c_orders`.`date_order_create`,
						`c_orders`.`date_order_change`,
						`c_orders`.`cart`,
						`c_orders`.`status`,
						`c_orders`.`comment`,
						`c_orders`.`ip`,
						`users`.`email`,
						`users`.`login`,
						`users`.`famil`,
						`users`.`name`,
						`users`.`email`,
						`users`.`otch`,
						`users`.`email`,
						`users`.`adress`,
						`users`.`avatar`,
						`users`.`status` AS user_status,
						`users`.`level`,
						`users`.`phone`,
						`users`.`date_registration`
				FROM `c_orders` inner join `users` ON `c_orders`.`user_id` = `users`.`id`
				ORDER BY `c_orders`.`date_order_create` DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_orders_by_status($val)
	{
		//$sql = "SELECT * FROM `c_orders`";
		$sql = "SELECT 	`c_orders`.`id`,
						`c_orders`.`user_id`,
						`c_orders`.`date_order_create`,
						`c_orders`.`date_order_change`,
						`c_orders`.`cart`,
						`c_orders`.`status`,
						`c_orders`.`comment`,
						`c_orders`.`ip`,
						`users`.`email`,
						`users`.`login`,
						`users`.`famil`,
						`users`.`name`,
						`users`.`email`,
						`users`.`otch`,
						`users`.`email`,
						`users`.`adress`,
						`users`.`avatar`,
						`users`.`status` AS user_status,
						`users`.`level`,
						`users`.`phone`,
						`users`.`date_registration`
				FROM `c_orders` inner join `users` ON `c_orders`.`user_id` = `users`.`id`
				WHERE `c_orders`.`status` = ?
				ORDER BY `c_orders`.`date_order_create` DESC";
		$query = $this->db->query($sql,$val);
		return $query->result_array();
	}
	
	function get_order_details($id)
	{
		$sql = "SELECT 	`c_orders`.`id`,
						`c_orders`.`user_id`,
						`c_orders`.`date_order_create`,
						`c_orders`.`date_order_change`,
						`c_orders`.`cart`,
						`c_orders`.`status`,
						`c_orders`.`comment`,
						`c_orders`.`ip`,
						`users`.`email`,
						`users`.`login`,
						`users`.`famil`,
						`users`.`name`,
						`users`.`email`,
						`users`.`otch`,
						`users`.`email`,
						`users`.`adress`,
						`users`.`avatar`,
						`users`.`status` AS user_status,
						`users`.`level`,
						`users`.`phone`,
						`users`.`date_registration`
				FROM `c_orders` inner join `users` ON `c_orders`.`user_id` = `users`.`id`
				WHERE `c_orders`.`id` = ?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	
	
	
	function del_order($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('c_orders'); 
	}
	
	function change_status_order($id,$value)
	{
		$data = array('status'=>$value);
		$this->db->where('id', $id);
		$this->db->update('c_orders', $data); 
	}
	
	function orders_of_user($id)
	{
		$sql = "SELECT * FROM `c_orders`
				WHERE `user_id` = ?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
}

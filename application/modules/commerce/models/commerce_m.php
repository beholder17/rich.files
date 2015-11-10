<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commerce_m extends CI_Model {

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
	function subcategory_is_parent($id)
	{
		$sql ="SELECT `id` FROM `c_subcategory` WHERE `parent` = ?";
		$query = $this->db->query($sql,$id);
		if ($query->num_rows() > 0) return true; else return false;		
	}
	
	function get_subcategory_by_parent($id)
	{
		$sql ="SELECT * FROM `c_subcategory` WHERE `id` = ?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	/*function his_parent($id)
	{
		$sql ="SELECT `id` FROM `c_subcategory` WHERE `parent` = ?";
		$query = $this->db->query($sql,$id);
		if ($query->num_rows() > 0) return true; else return false;		
	}*/
	
	function get_child_subcategory($id)
	{
		$sql ="SELECT * FROM `c_subcategory` WHERE `parent` = ? ORDER BY `name`";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	
	public function get_category_by_id($id)
	{
		$sql ="SELECT * FROM `c_category` WHERE `id` = ?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	
	public function get_subcategory_by_id($id)
	{
		$sql ="SELECT * FROM `c_subcategory` WHERE `id` = ?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	
	public function get_category($alias)
	{
		$this->db->cache_off();
		$sql ="SELECT * FROM `c_category` WHERE `alias` = '$alias'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function get_subcategory($alias)
	{
		$this->db->cache_off();
		$sql ="SELECT * FROM `c_subcategory` WHERE `alias` = '$alias'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function del_category($alias)
	{
		$sql ="DELETE FROM `c_category` WHERE id = $alias";
		$query = $this->db->query($sql);
		return true;
	}
	
		public function del_subcategory($alias)
	{
		$sql ="DELETE FROM `c_subcategory` WHERE id = $alias";
		$query = $this->db->query($sql);
		return true;
	}
	
		public function del_product($id)
	{
		$sql ="DELETE FROM `c_products` WHERE id = ?";
		$query = $this->db->query($sql,$id);
		return true;
	}
	
	
	public function get_catalog($category, $subcategory,$num, $offset,$parent=NULL)
	{
		if (!$offset) $offset = 0;
		/* get id that belonged to catgery/subcategory aliases */
		$category = $this->get_category($category);
		$subcategory = $this->get_subcategory($subcategory);		
		$sql ="SELECT * FROM `c_products` WHERE `category` = '".$category[0]['id']."' AND `status` = '1' AND `subcategory` = '".$subcategory[0]['id']."'  LIMIT $offset,$num";
		//$sql ="SELECT c_products.*, c_category.alias,  c_category.id, c_subcategory.id, c_subcategory.alias FROM `c_products` WHERE `category` = '".$category[0]['id']."' AND `subcategory` = '".$subcategory[0]['id']."'  LIMIT $offset,$num";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function product_existing($category, $subcategory)
	{		
		$category = $this->get_category($category);
		$subcategory = $this->get_subcategory($subcategory);		
		$sql ="SELECT `id` FROM `c_products` WHERE `category` = '".$category[0]['id']."' AND `subcategory` = '".$subcategory[0]['id']."' AND `status` = 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) return true;
		if ($query->num_rows() == 0) return false;
		
	}
	

	
		public function product_item_existing($category, $subcategory, $id)
	{
		$category = $this->get_category($category);
		$subcategory = $this->get_subcategory($subcategory);		
		//$sql ="SELECT `id` FROM `c_products` WHERE `category` = ? AND `subcategory` = ? AND `status` = 1 AND `id`=?";
		$sql ="SELECT `id` FROM `c_products` WHERE `category` = ? AND `subcategory` = ? AND `id`=?";
		$query = $this->db->query($sql,array($category[0]['id'],$subcategory[0]['id'],$id));
		if ($query->num_rows() > 0) return true;
		if ($query->num_rows() == 0) return false;
		
	}
		
		
	
	public function get_products_count($category,$subcategory)
	{
		$category = $this->get_category($category);
		$subcategory = $this->get_subcategory($subcategory);
		$sql ="SELECT c_products.id
		FROM c_products		
		WHERE c_products.category = ? AND c_products.subcategory =? AND c_products.status =1
		";		
		$query = $this->db->query($sql,array($category[0]['id'],$subcategory[0]['id']));
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
	
	function get_all_subcategories()
	{
		$sql ="SELECT * FROM `c_subcategory` ORDER BY `priority`";
		//$sql ="SELECT * FROM `c_subcategory`";
		$query = $this->db->query($sql);
		return $query->result_array();
		//return $this->db->get('c_subcategory')->result_array();
	}
	function get_all_categories()
	{
		return $this->db->get('c_category')->result_array();
	}
	
	function get_product($id)
	{
		$sql="SELECT c_products.`id`,
		c_products.name,
		c_products.name_tr,
		c_category.name AS `category`,
		c_category.alias AS `category_alias`,
		c_subcategory.name AS `subcategory`,
		c_subcategory.name_tr AS `subcategory_tr`,
		c_subcategory.alias AS `subcategory_alias`,
		c_products.description,
		c_products.description_tr,
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
		WHERE c_products.`id`='$id';";		
		$query = $this->db->query($sql);
		return $query->result_array();
		//return $sql;
	}
	
	function get_recommended_products($limit=1)
	{
		$sql="SELECT c_products.`id`,
		c_products.name,
		c_products.name_tr,
		c_category.name AS `category`,
		c_category.alias AS `category_alias`,
		c_subcategory.name AS `subcategory`,
		c_subcategory.alias AS `subcategory_alias`,
		c_products.description,
		c_products.description_tr,
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
		WHERE c_products.`recommended`='on'
		AND c_products.status = '1'
		LIMIT $limit";		
		$query = $this->db->query($sql);
		return $query->result_array();
		//return $sql;
	}
	
	function add_order($data){
		$this->db->insert('c_orders',$data);
	}
	function get_orders_by_user_id($id){
		$sql = "SELECT * FROM `c_orders` WHERE `user_id` = ? ORDER BY `date_order_create` DESC";
		$query = $this->db->query($sql,$id);
		return $query->result_array();		
	}
	
	function get_novelty_short($category,$subcategory)
	{
		$sql="SELECT c_products.`id`,
		c_products.name,
		c_products.name_tr,
		c_category.name AS `category`,
		c_category.alias AS `category_alias`,
		c_subcategory.name AS `subcategory`,
		c_subcategory.alias AS `subcategory_alias`,
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
		WHERE c_products.category = ?
		AND c_products.subcategory = ?
		AND c_products.novelty = 'on'
		AND c_products.status = '1'
		LIMIT 5";
		$query = $this->db->query($sql, array($category, $subcategory));
		return $query->result_array();		
	}
	
	function get_promo_short($category,$subcategory)
	{
		$sql="SELECT c_products.`id`,
		c_products.name,
		c_products.name_tr,
		c_category.name AS `category`,
		c_category.alias AS `category_alias`,
		c_subcategory.name AS `subcategory`,
		c_subcategory.alias AS `subcategory_alias`,
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
		WHERE c_products.category = ?
		AND c_products.subcategory = ?
		AND c_products.promo = 'on'
		AND c_products.status = '1'
		LIMIT 5";
		$query = $this->db->query($sql, array($category, $subcategory));
		return $query->result_array();
	}
	
	function get_novelty_full($category,$subcategory)
	{
		$sql="SELECT c_products.`id`,
		c_products.name,
		c_products.name_tr,
		c_category.name AS `category`,
		c_category.alias AS `category_alias`,
		c_subcategory.name AS `subcategory`,
		c_subcategory.alias AS `subcategory_alias`,
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
		WHERE c_products.category = ?
		AND c_products.subcategory = ?
		AND c_products.status = 1
		AND c_products.novelty = 'on'";
		$query = $this->db->query($sql, array($category, $subcategory));
		return $query->result_array();		
	}
	
	function get_promo_full($category,$subcategory)
	{
		$sql="SELECT c_products.`id`,
		c_products.name,
		c_products.name_tr,
		c_category.name AS `category`,
		c_category.alias AS `category_alias`,
		c_subcategory.name AS `subcategory`,
		c_subcategory.alias AS `subcategory_alias`,
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
		WHERE c_products.category = ?
		AND c_products.subcategory = ?
		AND c_products.status = 1
		AND c_products.promo = 'on'";
		$query = $this->db->query($sql, array($category, $subcategory));
		return $query->result_array();		
	}
	
	public function product_novelty_existing_cat($category)
	{		
		$sql ="SELECT `id` FROM `c_products` WHERE `category` = '".$category."' AND `novelty`='on' AND `status` = 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) return true;
		if ($query->num_rows() == 0) return false;		
	}	
	
	public function product_novelty_existing_subcat($category,$subcategory)
	{		
		$sql ="SELECT `id` FROM `c_products` WHERE `category` = '".$category."' AND `subcategory` = '".$subcategory."' AND `status` = 1 AND `novelty`='on'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) return true;
		if ($query->num_rows() == 0) return false;		
	}
	
	public function product_promo_existing_cat($category)
	{		
		$sql ="SELECT `id` FROM `c_products` WHERE `category` = '".$category."' AND `promo`='on' AND `status` = 1";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) return true;
		if ($query->num_rows() == 0) return false;		
	}
	
	public function product_promo_existing_subcat($category,$subcategory)
	{		
		$sql ="SELECT `id` FROM `c_products` WHERE `category` = '".$category."' AND `subcategory` = '".$subcategory."' AND `status` = 1 AND `promo`='on'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) return true;
		if ($query->num_rows() == 0) return false;		
	}
	
	function get_all_categories_novelty()
	{
		/*$sql="SELECT c_products.`id`,
		c_products.name,
		c_products.name_tr,
		c_category.name AS `category`,
		c_category.alias AS `category_alias`,
		c_subcategory.name AS `subcategory`,
		c_subcategory.alias AS `subcategory_alias`,
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
		WHERE c_products.novelty = 'on'		
		LIMIT 5";
		*/
		$sql="SELECT 
		c_category.name AS `name`,
		c_category.alias AS `category_alias`,
		c_subcategory.name AS `subcategory`,
		c_subcategory.alias AS `subcategory_alias`,
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
		c_type.`title-rus` AS `type`
		FROM c_products
		INNER JOIN c_category
		ON c_products.category = c_category.id
		INNER JOIN c_subcategory
		ON c_products.subcategory = c_subcategory.id
		INNER JOIN c_type
		ON c_products.type = c_type.id
		WHERE c_products.novelty = 'on'		
		LIMIT 5";
		$query = $this->db->query($sql);
		return $query->result_array();		
		//return $this->db->get('c_category')->result_array();
	}
	
	public $checkout_rules = array(
			array(
				'field' => 'name',
				'label' => 'Имя',
				'rules' => 'required|xss_clean|trim|cyr'
			),
			array(
				'field' => 'surname',
				'label' => 'Фамилия',
				'rules' => 'required|xss_clean|alpha|trim'
			),
			array(
				'field' => 'phone',
				'label' => 'Phone',
				'rules' => 'required|xss_clean|trim'
			),
			array(
				'field' => 'adress',
				'label' => 'Adress',
				'rules' => 'required|xss_clean|trim'
			),
			array(
				'field' => 'email',
				'label' => 'E-mail',
				'rules' => 'required|xss_clean|valid_email|trim'
			)
	);
}

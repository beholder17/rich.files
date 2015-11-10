<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reviews_m extends CI_Model
{

    public function get_all_approved_reviews($count, $offset)
    {
        $sql = "SELECT * FROM `reviews` WHERE `show` = 1 OR `show` = 'on' ORDER BY `date` LIMIT $offset, $count";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_approved_reviews_count()
    {
        $sql = "SELECT * FROM `reviews` WHERE `show` = 1 OR `show` = 'on'";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
	
	public function add_review($data)
	{
		$this->db->insert('reviews',$data);
	}
	
	public function review_delete($id){
		$sql ="DELETE FROM `reviews` WHERE id = ?";
		$query = $this->db->query($sql,$id);
		return true;
	}
	


    public $add_review_rules = array(
        array(
            "field" => 'name',
            "label" => 'Имя',
            "rules" => 'required|xss_clean|trim'
        ),
        array('field' => 'fulltext',
        'label' => 'Текст отзывы',
        'rules' => 'required|xss_clean|trim|max_length[15000]'
        ),
        array('field' => 'email',
        'label' => 'Ваш e-mail',
        'rules' => 'required|xss_clean|trim|valid_email'
        ),
		 array('field' => 'city',
        'label' => 'Ваш город',
        'rules' => 'required|xss_clean|trim'
        )
    );
	
	function get_all_reviews()
	{
		$sql = "SELECT * FROM `reviews` ORDER BY `date` DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
	}
	
	function get_all_unpublish_reviews()
	{
		$sql = "SELECT * FROM `reviews` WHERE `show`=0 ORDER BY `date` DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
	}
	
	function apply_changes($id, $data)
	{
		
		//var_dump($data);
		$this->db->where('id', $id);
		$query = $this->db->update('reviews', $data); 
		return $query;
	}



    /*

        public function get_content($category,$alias)
        {
            $sql ="SELECT * FROM `content` WHERE `alias` = ?";
            $query = $this->db->query($sql,$alias);
            return $query->result_array();
        }
        public function get_category_list($category,$num, $offset)
        {
            $sql ="SELECT content.id, content.title, content.description, content.keywords, content.fulltext, content.date, content.show, content.author, content.alias, content.visit_counter, content.image, content_category.category, content_category.name
            FROM content
            INNER JOIN content_category
            ON content_category.id = content.category
            WHERE content_category.category =  '$category'
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
            ";
            $query = $this->db->query($sql);
            return $query->num_rows();
        }

        public function get_content_block($category,$num)
        {
            $sql ="SELECT content.id, content.title, content.description, content.keywords, content.fulltext, content.date, content.show, content.author, content.alias, content.visit_counter, content.image, content_category.category, content_category.name
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
            $sql ="SELECT content.id, content.title, content.description, content.keywords, content.fulltext, content.date, content.show, content.author, content.alias, content.visit_counter, content.image, content_category.category, content_category.name, content.category AS category_id
            FROM content
            INNER JOIN content_category
            ON content_category.id = content.category
            WHERE content.id =  ?
            ORDER BY date DESC";
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
        }*/
}

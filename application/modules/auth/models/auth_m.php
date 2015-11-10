<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_m extends CI_Model {

	function user_info_update($data)
	{	
		$this->db->where('id',$data['id']);
		$this->db->update('users',$data);
	}
	
	function get_user_avatar($id)
	{
		$sql ="SELECT `avatar` FROM `users` WHERE `id` = ?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}

	public function check_auth_model($li,$pw)
	{
		$pw_hashed = md5(md5($pw)."salt57_rwdyY3_2");
		$this->db->where('email',$li);
		$this->db->where('pw',$pw_hashed);
		$query = $this->db->get('users');
		
		
        if ($query->num_rows()==1) $auth_result = array('respond'=>true);
		if ($query->num_rows()>1) $auth_result = array('respond'=>'error');
		if ($query->num_rows()==0) $auth_result = array('respond'=>false);
		$account_array = $query->result_array();
		$query = array_merge($account_array, $auth_result);
		return $query;
		/*
		Транскрипция результатов:
		
		
		*/
	}
	
	public $registration_rules = array(
			array(
				'field' => 'name',
				'label' => 'Имя',
				'rules' => 'required|xss_clean|cyr_alpha|trim|max_length[100]'
			),
			array(
				'field' => 'surname',
				'label' => 'Фамилия',
				'rules' => 'required|xss_clean|cyr_alpha|trim|max_length[100]'
			),
			array(
				'field' => 'phone',
				'label' => 'Phone',
				'rules' => 'required|xss_clean|trim|max_length[100]|min_length[5]'
			),
			array(
				'field' => 'city',
				'label' => 'City',
				'rules' => 'required|xss_clean|trim|max_length[200]'
			),
			array(
				'field' => 'pw',
				'label' => 'Password',
				'rules' => 'required|xss_clean|trim|min_length[6]|max_length[100]'
			),
			array(
				'field' => 'pw2',
				'label' => 'Password again',
				'rules' => 'required|xss_clean|trim|min_length[6]|max_length[100]|matches[pw]'
			),
			array(
				'field' => 'email',
				'label' => 'E-mail',
				'rules' => 'required|xss_clean|valid_email|trim|uniq_email_field'
			),
			array(
				'field' => 'captcha_auth',
				'label' => 'Captcha',
				'rules' => 'required|xss_clean|trim|max_length[20]'
			)
	);
	

	
	
	public $authorization_rules = array(
			array(
				'field' => 'email_auth',
				'label' => 'E-mail',
				'rules' => 'required|xss_clean|valid_email|trim|max_length[100]'
			),
			array(
				'field' => 'pw_auth',
				'label' => 'Password',
				'rules' => 'required|xss_clean|cyr_alpha|trim|max_length[100]'
			),
			array(
				'field' => 'captcha_auth',
				'label' => 'Captcha',
				'rules' => 'required|xss_clean|trim|max_length[20]'
			));
			
	public $forget_rules = array(
			array(
				'field' => 'email',
				'label' => 'E-mail',
				'rules' => 'required|xss_clean|trim|max_length[100]|valid_email'
			));
	
	public $recovery_rules = array(
			array(
				'field' => 'password',
				'label' => 'Пароль',
				'rules' => 'required|xss_clean|trim|max_length[100]|min_length[6]'
			),
			array(
				'field' => 'password2',
				'label' => 'Пароль повторно',
				'rules' => 'required|xss_clean|trim|max_length[100]|min_length[6]|matches[password]'
			));
	
	
	function registration_user($data)
	{
		$this->db->insert('users',$data);
	}
	
	function get_user_by_id($id)
	{
		$sql ="SELECT * FROM `users` WHERE `id` = ?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	
	function write_new_password($pw,$hash)
	{
		$this->db->where('hash',$hash);
		$this->db->update('users',array('pw'=>$pw));
		
		/*$this->db->set('p', $name); 
		$this->db->insert('mytable'); */
	}
	
		function get_user_by_email($email)
	{
		$sql ="SELECT * FROM `users` WHERE `email` = ?";
		$query = $this->db->query($sql,$email);
		
		if ($query->num_rows()!=0) return $query->result_array(); else return false;
		
	}
	
	function get_user_by_hash_mail($hash, $mail)
	{
		$sql = "SELECT * FROM `users` WHERE `hash` = ? AND `email` = ?";
		$query = $this->db->query($sql,array($hash,$mail));
		if ($query->num_rows()!=0) return $query->result_array(); else return false;
	}
	
	function check_uniq_email($mail)
	{
		$sql ="SELECT `id` FROM `users` WHERE `email` = ?";
		$query = $this->db->query($sql,$email);
		
		if ($query->num_rows()==0) return false; else return true;
	}

}

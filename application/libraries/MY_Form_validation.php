<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * Класс расширяющий правила Form_Validation, добавляя в них работу с кириллицей
 *
 * @package		CodeIgniter
 * @author		ZUMA
 * @copyright	Copyright (c) 2012, Максим Сергеевич Зубенко. (Россия) 
 * @license		freeware
 * @link		http://jawsik.com/myprogsandscripts/codeigniter-form_validation.php
 * @since		Version 1.0
 * @filesource	
 */

// ------------------------------------------------------------------------
class MY_Form_validation extends CI_Form_validation {
	
	// --------------------------------------------------------------------

	/**
	 * Буквы (английские и русские), цифры, а так же минус и нижнее подчёркивание
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	public function cyr_alpha_dash($str)
	{
		return ( ! preg_match("/^([-а-яёa-z0-9_-])+$/ui", $str)) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Буквы (английские и русские) и цифры
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	public function cyr_alpha_numeric($str)
	{
		return ( ! preg_match("/^([а-яёa-z0-9])+$/ui", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Буквы (английские и русские)
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	public function cyr_alpha($str)
	{
		return ( ! preg_match("/^([а-яёa-z])+$/ui", $str)) ? FALSE : TRUE;
	}
	// --------------------------------------------------------------------

	/**
	 * Буквы (только русские), цифры, а так же минус и нижнее подчёркивание
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	public function cyr_dash($str)
	{
		return ( ! preg_match("/^([-а-яё0-9_-])+$/ui", $str)) ? FALSE : TRUE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Буквы (только русские) и цифры
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	public function cyr_numeric($str)
	{
		return ( ! preg_match("/^([а-яё0-9])+$/ui", $str)) ? FALSE : TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Буквы (только русские)
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	public function cyr($str)
	{
		return ( ! preg_match("/^([а-яё])+$/ui", $str)) ? FALSE : TRUE;
	}	
	
	// --------------------------------------------------------------------
	
	/**
	 * Уникальный email
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	public function uniq_email_field($str)
	{		
		$link = mysql_connect("richworld.mysql", "richworld_mysql", "pjyyrnhk") or die("Не могу подключиться");
		mysql_select_db("richworld_ci", $link) or die ('Не могу выбрать БД');
		mysql_query("SET NAMES utf8");
		$query = "SELECT COUNT(*) AS 'count' FROM `users` WHERE `email` = '".$str."'";
		$result=mysql_query($query);
		mysql_close($link);
		$result = mysql_fetch_assoc($result);
		if ($result['count'] == 1) return false; else return true;
	}	
}

/**/
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter String Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/string_helper.html
 */

// ------------------------------------------------------------------------

/**
 * Trim Slashes
 *
 * Removes any leading/trailing slashes from a string:
 *
 * /this/that/theother/
 *
 * becomes:
 *
 * this/that/theother
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('make_alias'))
{
	function make_alias($str)
	{
		$converter = array(
		 'а' => 'a', 'б' => 'b', 'в' => 'v',
		 'г' => 'g', 'д' => 'd', 'е' => 'e',
		 'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
		 'и' => 'i', 'й' => 'y', 'к' => 'k',
		 'л' => 'l', 'м' => 'm', 'н' => 'n',
		 'о' => 'o', 'п' => 'p', 'р' => 'r',
		 'с' => 's', 'т' => 't', 'у' => 'u',
		 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
		 'ь' => "", 'ы' => 'y', 'ъ' => "",
		 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
		 ',' => '-', ' ' => '-', ':' => '-',
		 '?' => '', '!' => '', '.' => '',
		 'А' => 'A', 'Б' => 'B', 'В' => 'V',
		 'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
		 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
		 'И' => 'I', 'Й' => 'Y', 'К' => 'K',
		 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
		 'О' => 'O', 'П' => 'P', 'Р' => 'R',
		 'С' => 'S', 'Т' => 'T', 'У' => 'U',
		 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
		 'Ь' => "", 'Ы' => 'Y', 'Ъ' => "",
		 'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
		);
		$str = trim($str);
		$str = strtr($str, $converter);
		$str = mb_strtolower($str);
		$str = preg_replace ("/[^a-zA-ZА-Яа-я0-9-\s]/","",$str);
		$str = str_replace(' ', '-', $str);
		
		return $str;
		
	}
}


if ( ! function_exists('file_name_translit'))
{
	function file_name_translit($str)
	{
		$converter = array(
		 'а' => 'a', 'б' => 'b', 'в' => 'v',
		 'г' => 'g', 'д' => 'd', 'е' => 'e',
		 'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
		 'и' => 'i', 'й' => 'y', 'к' => 'k',
		 'л' => 'l', 'м' => 'm', 'н' => 'n',
		 'о' => 'o', 'п' => 'p', 'р' => 'r',
		 'с' => 's', 'т' => 't', 'у' => 'u',
		 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
		 'ь' => "", 'ы' => 'y', 'ъ' => "",
		 'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
		 ',' => '-', ' ' => '-', ':' => '-',
		 '?' => '', '!' => '', '.' => '.',
		 'А' => 'A', 'Б' => 'B', 'В' => 'V',
		 'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
		 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
		 'И' => 'I', 'Й' => 'Y', 'К' => 'K',
		 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
		 'О' => 'O', 'П' => 'P', 'Р' => 'R',
		 'С' => 'S', 'Т' => 'T', 'У' => 'U',
		 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
		 'Ь' => "", 'Ы' => 'Y', 'Ъ' => "",
		 'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
		);
		$str = trim($str);
		$str = strtr($str, $converter);
		$str = mb_strtolower($str);
		$str = preg_replace ("/[^a-zA-ZА-Яа-я0-9-.\s]/","",$str);
		$str = str_replace(' ', '-', $str);
		
		return $str;
		
	}
}
// ------------------------------------------------------------------------

/**
 * Strip Slashes
 *
 * Removes slashes contained in a string or in an array
 *
 * @access	public
 * @param	mixed	string or array
 * @return	mixed	string or array
 */
if ( ! function_exists('strip_slashes'))
{
	function strip_slashes($str)
	{
		if (is_array($str))
		{
			foreach ($str as $key => $val)
			{
				$str[$key] = strip_slashes($val);
			}
		}
		else
		{
			$str = stripslashes($str);
		}

		return $str;
	}
}

if ( ! function_exists('is_auth'))
{
	function is_auth()
	{
		
	}
}

if ( ! function_exists('base_url_lang'))
{
	function base_url_lang()
	{
		return $base_url().$this->uri->segment(1);
	}
}


/* End of file my_helper.php */
/* Location: ./system/helpers/string_helper.php */
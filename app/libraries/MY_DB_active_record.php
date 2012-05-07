<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */



/**
 * Logging Class extention. We just add log level for PHP error making them more readable
 * and clear applicative logs
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Logging
 * @author	Mickael Suisse m.suisse@gmail.com
 */
class  MY_DB_active_record extends CI_DB_active_record {
	protected $_levels	= array('ERROR' => '1', 'DEBUG' => '2',  'INFO' => '3',  'PHP_ERROR' => '4', 'ALL' => '5');
}
// END Log Class

/* End of file Log.php */
/* Location: ./system/libraries/Log.php */

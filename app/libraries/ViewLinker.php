<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CIDisplayModifiers
 *
 * An open source modification for the great CI project
 *
 * @package		CIDisplayModifiers
 * @author		Mickael Suisse m.suisse@gmail.com
 * @copyright	copyleft you selfish bastard!
 * @license		https://www.gnu.org/licenses/gpl.html
 * @link		https://www.gnu.org/licenses/gpl.html
 * @filesource
 */

/**
 * CI display modifiers package is a set of tools to modify display routines
 * Display Modifier extention that allow you to set header and footer php files, autoload a general list of JS and CSS 
 * and if you need it to set add some dedicated ones in any controller. It do not extends CI_view but has one,
 * so it is mean to be used in your controller in place of view native librairie. You can anyway use normal CI view librairy
 * in any controller
 *
 * @package		CIDisplay
 * @subpackage	Libraries
 * @category	Display Modifiers 
 * @author	Mickael Suisse m.suisse@gmail.com
 */
class ViewLinker {
	
	public $base_view;
	
	private $A_css_sheets = Array();
	private $A_js_scripts = Array();
	private $CI;
		
	public function __construct () {
		$this->CI =& get_instance();
		$this->CI->config->load('view_linker');
		$this->CI->load->helper('view_linker');
	}
	
	public function addCssSheet($css_file) {
		$this->A_css_sheets[] = $css_file;
	}
	
	public function addJsScript($js_script) {
		$this->A_js_scripts[] = $js_script;
	}
	
	public function getCssSheets() {
		return array_merge($this->CI->config->item('A_default_css_sheets'), $this->A_css_sheets );
	}
	
	public function getJsScripts() {
		return array_merge($this->CI->config->item('A_default_js_scritps'), $this->A_js_scripts );
	}
	
	public function view($page_to_render, $page_data = null) {
		$this->base_view = $page_to_render;
		
		$header_data['cssSheets'] = $this->getCssSheets();
		$header_data['jsScripts'] = $this->getJsScripts();
		$this->CI->load->view('common/header', $header_data);
		$this->CI->load->view($this->base_view, $page_data);
		$this->CI->load->view('common/footer');		
	}
}

/* End of file ViewLinker.php */
/* Location: ./app/libraries/ViewLinker.php */

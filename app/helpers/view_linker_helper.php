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
 * CIDisplayModifiers Helpers
 *
 * @package		CIDisplay
 * @subpackage	Helpers
 * @category	Display Modifiers 
 * @author	Mickael Suisse m.suisse@gmail.com
 */

// ------------------------------------------------------------------------

if ( ! defined('_CSS_DIR_') || ! defined('_JS_DIR_')) exit('You must define images path before!');
/**
 * compose CSS link tag for page construction
 *
 * Returns link html tags
 *
 * @access	public
 * @param Array $css_sheets
 * @return	string
 */
if ( ! function_exists('link_css_sheets')) {
	function link_css_sheets($css_sheets) {
		$buffer = null;
		foreach($css_sheets as $css_file) {
			$buffer .= '<link href="'._CSS_DIR_.$css_file.'.css" rel="stylesheet" type="text/css" />'."\n";
		}
		return $buffer;
	}
}

/**
 * compose JS link tag for page construction
 *
 * Returns link html tags
 *
 * @access	public
 * @param Array $jsScripts
 * @return	string
 */
if ( ! function_exists('link_js_scripts')) {
	function link_js_scripts($jsScripts) {
		$buffer = null;
		foreach($jsScripts as $js_file) {
			$buffer .= '<script  type="text/javascript" src="'._JS_DIR_.$js_file.'.js"></script>'."\n";
		}
		return $buffer;
	}
}
/* End of file date_helper.php */
/* Location: ./system/helpers/date_helper.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {

	/**
	* Index Page for this controller.
	*
	*/
	public function index() {
//		$this->viewlinker->addJsScript('include/welcome');
    	$view_data = null;
    	$this->viewlinker->view('import_index', $view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
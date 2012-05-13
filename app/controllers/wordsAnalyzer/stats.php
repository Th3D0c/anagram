<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stats extends CI_Controller {

	/**
	* Index Page for this controller.
	*
	*/
	public function index() {
        //Set d'include pour le Rose Chart de RGraph
        $this->viewlinker->addJsScript('rgraph/RGraph.common.core');
        $this->viewlinker->addJsScript('rgraph/RGraph.common.tooltips');
        $this->viewlinker->addJsScript('rgraph/RGraph.common.dynamic');
        $this->viewlinker->addJsScript('rgraph/RGraph.rose');
        $this->viewlinker->addJsScript('include/stats');
        $this->load->database();

        // repartirtion de lettres dans les mots :
        /*
         * select count(*), letter_value from test.letters_by_words join letters using(letter_id) group by letter_id, letter_value order by letter_value
         */

        
    	$view_data = null;
    	$this->viewlinker->view('wordsAnalyzer/stats_index', $view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

//select * from test.words w WHERE word_id IN ( SELECT word_id from test.words w2 WHERE w2.word_value=w.word_value  ) > 0
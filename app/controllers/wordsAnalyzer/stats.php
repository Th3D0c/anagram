<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stats extends CI_Controller {

    public function countsByFirstLetter() {
        $this->load->database();
        $result = $this->db->query('SELECT SUBSTR(word_value, 1,1) as first_letter, COUNT(*) FROM test.words GROUP BY SUBSTR(word_value, 1,1)');
        foreach ($result->result() as $row) {
            $graph_data['labels_list'][] = $row->first_letter;
            $graph_data['values_list'][] = (int)$row->count;
            $graph_data['values_string_list'][] = $row->count;
        }
        echo json_encode($graph_data);

    }

    public function validatedStats() {
        $this->load->database();
        $query = $this->db->query('SELECT COUNT(*) FROM test.words WHERE validated = true');
        $result = $query->result();
        $graph_data['validated_words'] = (int)$result[0]->count;

        $query = $this->db->query('SELECT COUNT(*) FROM test.words');
        $result = $query->result();
        $graph_data['total_words'] = (int)$result[0]->count;
        echo json_encode($graph_data);

    }


	/**
	* Index Page for this controller.
	*
	*/
	public function index() {
        //Set d'include pour le Rose Chart de RGraph
        $this->viewlinker->addJsScript('rgraph/RGraph.common.core');
        $this->viewlinker->addJsScript('rgraph/RGraph.common.tooltips');
        $this->viewlinker->addJsScript('rgraph/RGraph.common.dynamic');
//        $this->viewlinker->addJsScript('rgraph/RGraph.rose');
        $this->viewlinker->addJsScript('rgraph/RGraph.bar');
        $this->viewlinker->addJsScript('rgraph/RGraph.vprogress');
        $this->viewlinker->addJsScript('include/stats');
        $this->load->database();

        // repartirtion de lettres dans les mots :
        /*
         * select count(*), letter_value from test.letters_by_words join letters using(letter_id) group by letter_id, letter_value order by letter_value
         */

        // repartition des mots par premiere lettre
        /*
         * SELECT SUBSTR(word_value, 1,1), COUNT(*) FROM test.words GROUP BY SUBSTR(word_value, 1,1)
         */


    	$view_data = null;
    	$this->viewlinker->view('wordsAnalyzer/stats_index', $view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

//select * from test.words w WHERE word_id IN ( SELECT word_id from test.words w2 WHERE w2.word_value=w.word_value  ) > 0